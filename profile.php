<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLogged()) {
	$data = $user->data();
	getHeader();

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
						<li>
							<a href="wall.php">
							<i class="glyphicon glyphicon-home"></i>
							Timeline </a>
						</li>
						<li class="active">
							<a href="profile.php">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Friends </a>
						</li>
						<li>
							<a href="#">
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
			<table class="table">
				<thead>
					<th><h1>Profile Overview</h1></th>
				</thead>
				<tr>
					<td><b>Name</b></td>
					<td><?=$data->name?></td>
				</tr>
				<tr>
					<td><b>Email</b></td>
					<td><?=$data->email?></td>
				</tr>
				<tr>
					<td><b>Joined</b></td>
					<td><?=humanReadableDate($data->joined)?></td>
				</tr>
				<tr>
					<td>
						<p class="lead"><i class="glyphicon glyphicon-asterisk"></i><?=($data->email==$data->username)?"You're a google user":"This is your profile overview"?></p>
					<td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</div>


<?php die();?>	<!-- header section -->
	<div class="col-md-12">
		<div class="jumbotron">
		<h2>Profile Of User: <?php echo escape($user->data()->username) ?></h2>
		</div>
	</div>
	<?php require 'includes/pages/nav.php'; ?>
	<!-- content section -->
	<div class="col-md-8">
		<table class="table">
			<thead>Profile Of User: <?php echo escape($user->data()->username) ?></thead>
			<tr>
				<td>Name: </td>
				<td><?php echo escape($user->data()->name) ?></td>
			</tr>
			<tr>
				<td>Group: </td>
				<td><?php echo escape($user->data()->group) ?></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>

<?php
}else{
	Redirect::to(404);
}
?>