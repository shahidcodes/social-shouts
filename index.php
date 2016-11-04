<?php
/*
 * load the autoload file
 * define the constants client id,secret and redirect url
 * start the session
 */
require_once __DIR__ . '/core/init.php';
require_once __DIR__ . '/3rdPartyLibs/vendor/autoload.php';

define('CLIENT_ID', Config::get("gplus_auth/client_id"));
define('CLIENT_SECRET', Config::get("gplus_auth/client_secret"));
define('REDIRECT_URI', Config::get("gplus_auth/redirect_url"));

$google_client = new Google_Client;
$google_auth   = new GoogleAuth($google_client);

$google_auth->authenticateWithCode();
// var_dump($_SESSION);
$user = new User();

// die();
if ($user->isLogged()) {
    // echo "Logged In, <a href='logout.php'>Log out</a>";
    Redirect::to("wall.php");
}
// else{
//   echo '<a href="'. $google_auth->getAuthUrl(). '">Sign In</a>';
// }
$csrfToken = Token::generate();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Social Shouts | Login</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="styles/app.css" />
  <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body style="background-color: black">
<div id="loginbox"  style="display:<?=(isset($_GET['signup']))?"none":"block"?>margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<div class="panel panel-default" >
  <div class="panel-heading">
      <img class="center" src="styles/images/logo.png" />
      <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
  </div>

  <div style="padding-top:30px" class="panel-body" >
      <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
      <form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">
          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
          </div>
          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
          </div>
          <?php Session::put('secure', rand(1000, 9999)); ?>
          <div class="form-group">
          <div class="col-md-5">
            <label for="captcha">Captcha: </label>
            <img src="cap.php"><?php echo Session::flash('errorCap'); ?>
          </div>
          <div class="col-md-5">
            <input type="text" name="captcha" class="form-control" value="" placeholder="Enter Text Shown In Image" autocomplete="false" /> 
          </div>
          </div>
          <input type="hidden" name="token" value="<?=$csrfToken ?>">
          <div class="input-group">
              <div class="checkbox">
                <label>
                  <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                </label>
              </div>
          </div>


              <div style="margin-top:10px" class="form-group">
                  <!-- Button -->

                  <div class="col-sm-12 controls">
                    <input type="submit" id="btn-login" class="btn btn-success">
                    <a href="<?=$google_auth->getAuthUrl()?>"><img class="gplusloginpng" src="styles/images/signin_button.png"></a>

                  </div>
              </div>


              <div class="form-group">
                  <div class="col-md-12 control">
                      <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                          Don't have an account!
                      <a id="signuplink" href="#">
                          Sign Up Here
                      </a>
                      </div>
                  </div>
              </div>
          </form>



      </div>
  </div>
</div>
<div id="signupbox" style="display:<?=(isset($_GET['signup']))?"block":"none"?>; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px">
              <a id="signinlink" href="#">Sign In</a>
            </div>
        </div>
        <div class="panel-body" >
            <form id="signupform" method="post" class="form-horizontal" role="form" action="register.php">
                <div id="signupalert" style="display:<?=(Input::get("signup-success")!="")?"block":"none"?>" class="alert alert-danger">
                    <p><?=Session::flash("msg")?></p>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Password Again</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password-again" placeholder="Password">
                    </div>
                </div>
                <?php Session::put('secure', rand(1000, 9999)); ?>
              <div class="form-group">
              <div class="col-md-5">
                  <label for="captcha">Captcha: </label>
                  <img src="cap.php"><?php echo Session::flash('errorCap'); ?>
              </div>
              <div class="col-md-6">
                <input type="text" name="captcha" class="form-control">
              </div>
              </div>

              <input type="hidden" name="token" value="<?=$csrfToken?>">

                <div class="form-group">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-warning" value="Sign Up" />
                        <span style="margin-left:8px;">or</span>
                        <a href="<?=$google_auth->getAuthUrl()?>">
                        <img class="gplusloginpng" src="styles/images/signin_button.png">
                        </a>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#signinlink").on("click", function() {
      $('#signupbox').hide();
      $('#loginbox').show();
    });
    $("#signuplink").on("click", function() {
      $('#loginbox').hide();
      $('#signupbox').show();
    });
  });
</script>
<?php

getFooter();
