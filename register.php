<?php 
require_once 'core/init.php';
if (Input::exists()) {	//check if Get/Post isnt empty
	if (Token::check(Input::get('token')) && Captcha::check(Input::get('captcha'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required'	=> true,
				'min' 		=> '2',
				'max'		=> '20',
				'unique'	=> 'users'
				),
			'password' => array(
				'required'	=> true,
				'min'		=> '6'
				),
			'password-again' => array(
				'required'	=> true,
				'min'		=> '6',
				'matches'	=> 'password'
				),
			'name' => array(
				'required'	=> true,
				'max'		=> '50',
				'min'		=> '2'
				)
			));
		if ($validation->passed()) {
            //salt to be stored in db
			$salt = Hash::salt(32);
			try {
				$user = new User(); 
				$user->createUser(array( //fields array in User::createUser method
					'username' => Input::get('username'),
					'email'		=> Input::get("email"),
					'password' => Hash::make(Input::get('password'), $salt) ,
					'salt' => $salt ,
					'joined' => date('Y-m-d H:i:s'),
					'name' => Input::get('name'),
					'group' => 1,
					"google_id" => "",
					"avator"	=> "https://www.gravatar.com/avatar/".md5($email)."?d=mm&f=y&s=200"
					));
				Session::flash('msg', 'You have been registered. You can Login!');
				Redirect::to('index.php?signup-success');
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}else{
			Session::flash('error', $validation->errors());

		}
	}
}