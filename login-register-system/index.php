<?php 

include 'lib/user.php';
include 'inc/header.php';

$login 		= Session::get('login');
$name 		= Session::get('name');
$loginmsg 	= Session::get('loginmsg');

/* Redirect to login page when you are logged-out */
Session::checkLogin();
?>
<main>
	<div class="container my-5">
		<div class="row">
			<?php 
			// Showing the msg after login
			echo isset($loginmsg) ? $loginmsg : "";

			// Clear the msg after one refresh
			Session::set('loginmsg',NULL);
			?>
			<div class="col-md-12">
				<div class="shadow mb-3">
					<div class="card-header">
						<h2 class="d-inline-block">User List</h2>
						<span class="float-end">
							<?php 
							echo ($login==true AND isset($name)) ? "Welcome ! ".$name : "";
							?>
						</span>
					</div>
					<div class="card-body">
						<table class="table rounded">
							<thead>
								<tr class="table-dark">
									<th>Serial</th>
									<th>Name</th>
									<th>Username</th>
									<th>Email</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$user 		= new User();
								$userdata 	= $user->getUserData();
								$session_id = Session::get('id');

								if ($userdata) :
									$id = 0;
									foreach($userdata as $_user ):
										$id++;
										?>
										<tr class="<?php echo $session_id == $_user['id'] ? "fw-bold" : ""; ?>">
											<td><?php echo $id; ?></td>
											<td><?php echo $_user['name']; ?></td>
											<td><?php echo $_user['username']; ?></td>
											<td><?php echo $_user['email']; ?></td>
											<td><a href="profile.php?id=<?php echo $_user['id']; ?>" class="btn btn-<?php echo $session_id == $_user['id'] ? "warning" : "primary"; ?> btn-sm">View</a></td>
										</tr>
										<?php 
									endforeach;
								else :
									?>
									<h1>No userdata found</h1>
									<?php 
								endif;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
include 'inc/footer.php'
?>