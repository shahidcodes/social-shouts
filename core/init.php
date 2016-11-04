<?php
session_start();
header('X-Frame-Options : DENY') ;
$GLOBALS['config'] = array(
	'gplus_auth'		=> array(
		'client_id'	=> '210958788609-mrob5dgijur9nlg2qu2lasht1fu6hppo.apps.googleusercontent.com',
		'client_secret' => 'zQ-vFEMn6tA97R9CaOhW41D3',
		'redirect_url'	=> 'http://127.0.0.1/oauth2google/index.php'
		),
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'socialbudd'
		),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
		),
	'session' => array(
		'session_name' => 'user',
		'token_name'	=> 'access_token',
		'csrf_token_name'	=> 'csrf_shahid'
		)
	);
function my_auto_loader($class){
	require_once 'classes/'. $class .'.php';
}
spl_autoload_register('my_auto_loader');
require_once 'functions/sanitize.php';
require_once 'functions/functions.php';
$cookie_name = Config::get('remember/cookie_name');
if (Cookie::exists($cookie_name) && !Session::exists(Config::get('session/session_name'))) {
	//check cookie hash == to that stored in db
	$hash = Cookie::get($cookie_name);
	$checkHash = DB::getinstance()->get('users_session', array('hash', '=', $hash));
	if ($checkHash->count()) {
		$user = new User($checkHash->first()->user_id);
		$user->login();
	}
}
