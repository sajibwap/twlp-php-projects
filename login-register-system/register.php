<?php 

include 'lib/user.php';
include 'inc/header.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['submit'])) {
	$userReg = $user->userRegistration($_POST);
}

/* Redirect to index page when you are logged-in */
Session::checkSession();
?>
<main>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="shadow mb-3">
					<div class="card-header text-center">
						<h3>Sign-up here</h3>
					</div>
					<div class="card-body p-5">
						<form class="mx-auto" style="max-width: 700px" action="" method="post">
							
							<?php 
							echo $userReg ?? ""; 
							// $user->show_data();
							?>
							<div class="custom form-group shadow my-2">
								<label for="name">Your Name</label>
								<input class="form-control" type="text" id="name" name="name" placeholder="Enter your name">
							</div>

							
							<div class="custom form-group shadow my-2">
								<label for="username">Username</label>
								<input class="form-control" type="text" id="username" name="username" placeholder="Enter your username">
							</div>

							
							<div class="custom form-group shadow my-2">
								<label for="email">Email Address</label>
								<input class="form-control" type="text" id="email" name="email" placeholder="Enter your email">
							</div>

							
							<div class="custom form-group shadow my-2">
								<label for="password">Password</label>
								<input class="form-control" type="text" id="password" name="password" placeholder="Enter your password">
							</div>
							<input type="submit" name="submit" value="Register" class="btn btn-primary w-100">
							<!-- <button type="submit" name="register" class="btn btn-primary">Register</button> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
include 'inc/footer.php'
?>