<?php

require_once 'core/init.php';

if (Input::exists()) {
  if (Token::check(Input::get('token')) && Captcha::check(Input::get('captcha'))) { //checking if token exists
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('required'  => true),
      'password' => array('required'=> true,'min'=> '6')
      ));
    if ($validation->passed()) { //method chaining
  		$user = new User();
      $remember = (Input::get('remember') === 'on') ? true : false;
  		$login = $user->login(Input::get('username'), Input::get('password'), $remember);
  		if ($login) {
  			Redirect::to('wall.php');
  		}
    }else{
  		Session::flash('le', $validation->errors());
  	}
  }else if(Captcha::error()){
  	Session::flash('errorCap', 'Captcha Mismatch');
  }
}