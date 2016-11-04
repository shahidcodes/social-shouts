<?php

class Token{

	public static function generate()

	{

		return Session::put(Config::get('session/csrf_token_name'), md5(uniqid()));

	}



	public static function check($token)

	{

		$tokenName = Config::get('session/csrf_token_name');

		if (Session::exists($tokenName) && $token === Session::get($tokenName)) {

			Session::delete($tokenName);

			return true;

		}

		return false;

	}

}