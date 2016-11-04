<?php

/**
* Auth Class to Handle All Google Client Related Operations
*/
class GoogleAuth
{
	protected $client;	
	function __construct(Google_Client $client= null)
	{	
		$this->client = $client;
		if($this->client){
			$this->_db = DB::getInstance();

			// init google_client variable
			$this->client = new Google_Client();
			$this->client->setClientId(CLIENT_ID);
			$this->client->setClientSecret(CLIENT_SECRET);
			$this->client->setRedirectUri(REDIRECT_URI);
			$this->client->setScopes('email');

		}
	}
	public function authenticateWithCode()
	{
		if(Input::exists("get") && Input::get("code") !== ""){
			$code = Input::get("code");
			// pass code to google server
			$this->client->authenticate($code);
			$this->setToken($this->client->getAccessToken());
			$payload = $this->getUserPayload();
			$user = new User();
			// search user in database
			$googleUser = $user->findByGoogleID($payload["google_id"]);
			if ($user->isLogged()) {

				Redirect::to("wall.php?data={$user->data()->id}");

			}else if (!$googleUser) {
				// create user entry in database and login
				$payload["username"] = $payload["email"];
				$payload["password"] = md5($payload["email"]);
				$payload["salt"] = Hash::salt(32); 
				$payload["joined"]	= date('Y-m-d H:i:s');
				$payload["group"]	= 1;
				try{
					$user->createUser($payload);
					// log user in
					$user->loginByGoogleID($payload["google_id"]);
					// redirect back to wall.php
					Redirect::to("wall.php");
				}
				catch (Exception $e){
					Session::flash("Error While Signing up In. Please Use Another Method");
					Redirect::to("wall.php");
				}
				
			}
		}

		return false;
	}

	public function getUserPayload()
	{
		// $payload = $this->client->verifyIdToken()->getAttributes()["payload"];
		$this->plus = new Google_Service_Plus($this->client);
		$me = $this->plus->people->get('me');
		$id = $me['id'];
		$name =  $me['displayName'];
		$email =  $me['emails'][0]['value'];
		$profile_image_url = $me['image']['url'];
		return [
			"google_id" => $id,
			"name"		=> $name,
			"email"		=> $email,
			"avator"	=> $profile_image_url
		];
	}
	public function setToken($token)
	{
		if ($token) {
			Session::put( Config::get("session/token_name"), $token);
			$this->client->setAccessToken($token);
		}
	}
	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}
	public function isLoggedIn()
	{
		return Session::exists(Config::get("session/token_name"));
	}

	public function logout(){
		return Session::delete(Config::get("session/token_name"));
	}

}