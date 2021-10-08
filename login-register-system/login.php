<?php 

include 'inc/header.php';
include 'lib/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['login'])) {
	$userLogin = $user->userLogin($_POST);
}
/* Redirect to index page when you are logged-in */
Session::checkSession();
?>
<main>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="form-signin shadow">
					<!-- Show the error message  -->
					<?php echo $userLogin ?? ""; ?>
					<form class="form" method="post">
						
						<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

						<div class="form-floating">
							<input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
							<label for="email">Email address</label>
						</div>
						<div class="form-floating">
							<input type="text" name="password" class="form-control" id="password" placeholder="Password">
							<label for="password">Password</label>
						</div>

						<div class="checkbox mb-3">
							<label>
								<input type="checkbox" value="remember-me"> Remember me
							</label>
						</div>
						<input type="submit" name="login" value="Login" class="w-100 btn btn-lg btn-primary">
						<!-- <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Sign in</button> -->
						
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
include 'inc/footer.php';
?>