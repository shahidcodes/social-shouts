<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLogged()) {
getHeader(); // located in functions.php
$data = $user->data();
if (Input::exists()) {
	$post_body = Input::get("post_body");
	$postObject = new Posts;
	$fields = [
			"body"	 	=> $post_body,
			"user_id"	=> $data->id,
			"date"		=> date('Y-m-d H:i:s'),
		];
	if( $postObject->create( $fields ) ){
		Session::flash("msg", "<div class='alert alert-success'>Posted!</div>");
	}
}
?>
	<div class="row profile">
	<?=Session::flash("msg")?>
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="<?=$data->avator?>" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?=$data->name?>
					</div>
					<div class="profile-usertitle-job">
						User
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<!-- <div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div> -->
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="wall.php">
							<i class="glyphicon glyphicon-home"></i>
							Timeline </a>
						</li>
						<li>
							<a href="profile.php">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" onclick="alert('To be Implemented')">
							<i class="glyphicon glyphicon-ok"></i>
							Friends </a>
						</li>
						<li>
							<a href="#" onclick="alert('To be Implemented')" >
							<i class="glyphicon glyphicon-flag"></i>
							Something Else </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
			<div class="profile-content">
			<form action="" method="POST" role="form">
				<div class="form-group">
					<textarea name="post_body" rows="5" class="form-control"></textarea>
				</div>
				<input type="submit" class="btn btn-sm btn-info" value="Shout">
			</form><br>
			<?php
			$from = 0;
			$perPage = 10;
			if (Input::exists("get")) {
					$from = Input::get("from");
					$perPage = Input::get("per_page");

			}
			$postObject = new Posts();
			$posts = $postObject->getPosts($from, $perPage);
			foreach ($posts as $post) {
				$postUser = new User($post->user_id);
				$postUserData = $postUser->data();
			?>

			<div class="row">
			<div class="col-md-1">
			<div class="thumbnail">
			<img class="img-responsive user-photo" src="<?=$postUserData->avator?>">
			</div><!-- /thumbnail -->
			</div><!-- /col-sm-1 -->

			<div class="col-md-10">
			<div class="panel panel-default">
			<div class="panel-heading">
			<strong><?=$postUserData->name?></strong> <span class="text-muted">posted <?=humanReadableDate($post->date)?></span>
			</div>
			<div class="panel-body">
			<?=$post->body?>
			</div><!-- /panel-body -->
			</div><!-- /panel panel-default -->
			</div><!-- /col-sm-5 -->
			</div> <!-- /row-->
			   <?php
				}
			   ?>
			</div>
		</div>
	</div>
</div>
<?php
getFooter();
}else{
	Session::flash("msg", "Session Expired Please Log In Again");
	Redirect::to("index.php");
}