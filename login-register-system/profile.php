<?php 

include 'lib/user.php';
include 'inc/header.php';

/* Redirect to login page when you are logged-out */
Session::checkLogin();

$userid = isset($_GET['id']) ? $_GET['id'] : "";

$user 		= new User();
$get_user 	= $user->getUserDataByID($userid);


if ($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['update'])) {
	$update_user = $user->updateUserDataByID($userid,$_POST);
}


?>
<main>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="shadow mb-3">

					<div class="card-header d-flex justify-content-between">
						<h2>Profile info</h2>
						<a href="index.php"><button class="btn shadow btn-outline-dark">Back</button></a>
					</div>
					<div class="card-body p-5">
						<?php echo isset($update_user) ? $update_user : ""; ?>
						<form class="mx-auto" style="max-width: 700px" action="" method="post">
							
							<div class="form-group my-3">
								<label for="name">Your Name</label>
								<input class="form-control" type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo $get_user['name']; ?>">
							</div>

							
							<div class="form-group my-3">
								<label for="username">Username</label>
								<input class="form-control" type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo $get_user['username']; ?>">
							</div>

							
							<div class="form-group my-3">
								<label for="email">Email Address</label>
								<input class="form-control" type="text" id="email" name="email" placeholder="Enter your email" value="<?php echo $get_user['email']; ?>">
							</div>
							<?php 
							$session_id = Session::get('id');
							if ($userid == $session_id): 
								?>
								<button type="submit" name="update" class="btn btn-primary">Update</button>
								<a href="changepass.php?id=<?php echo $userid; ?>" class="btn btn-outline-dark">Change Password</a>
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