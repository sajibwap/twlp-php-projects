<?php 

include 'lib/user.php';
include 'inc/header.php';

/* Redirect to login page when you are logged-out */
Session::checkLogin();

$userid = isset($_GET['id']) ? $_GET['id'] : "";
if($userid!=$pid){
	header('Location: index.php');
}

$user = new User();


if ($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['updatepass'])) {
	$update_pass = $user->updatePassword($userid,$_POST);

}
$get_user = $user->getUserDataByID($userid);
?>
<main>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="shadow mb-3">

					<div class="card-header d-flex justify-content-between">
						<h2>Change Password</h2>
						<a href="profile.php?id=<?php echo $userid; ?>"><button class="btn shadow btn-outline-dark">Back</button></a>
					</div>
					<div class="card-body p-5">
						<?php echo isset($update_pass) ? $update_pass : ""; ?>
						<form class="mx-auto" style="max-width: 700px" action="" method="post">
							
							<div class="form-group my-3">
								<label for="name"><b>Old Password</b></label>
								<input class="form-control" type="password" id="old_password" name="old_password" placeholder="Enter old Password">
							</div>

							
							<div class="form-group my-3">
								<label for="username"><b>New Password</b></label>
								<input class="form-control" type="password" id="new_pass" name="new_password" placeholder="Enter your new Password">
							</div>

							<?php 
							$session_id = Session::get('id');
							if ($userid == $session_id): 
								?>
								<button type="submit" name="updatepass" class="btn btn-primary">Change</button>
							<?php endif; ?>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
include 'inc/footer.php'
?>