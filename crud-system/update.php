<?php 
include 'lib/config.php';
include 'lib/database.php';
include 'inc/header.php';
?>

<?php 

$db = new Database();
$id = $_GET['id'];

/**
 * Fetching data by id
 */

$query 	 = "SELECT * FROM tbl_user WHERE id = $id";
$getData = $db->select($query)->fetch_assoc();

/**
 * Update data into Database
 */
$error 	= "";
if (isset($_POST['submit'])) {
	$name 	= mysqli_real_escape_string($db->connect, $_POST['name']);
	$email 	= mysqli_real_escape_string($db->connect, $_POST['email']);
	$skill 	= mysqli_real_escape_string($db->connect, $_POST['skill']);
	if ($name == "" OR $email == "" OR $skill == "") {
		$error = "Field must not be empty";
	}else{
		$query 	= "UPDATE tbl_user
		SET name = '$name',email = '$email',skill = '$skill'
		WHERE id = $id";
		$db->update($query);
	}
}

?>
<main>
	<div class="container my-3">
		<div class="row">
			<div class="col-md-12">
				<div class="shadow mb-3">
					<div class="card-header">
						<h2 class="d-inline-block">Update a user</h2>
						<span class="float-end">
							<a class="btn btn-primary btn-sm" href="index.php">User list</a>
						</span>
					</div>
					<div class="card-body">
						<div class='text-success text-center'><?php echo $error; ?></div>
						<form class="mx-auto" style="max-width: 700px" method="post">
							<div class="custom form-group shadow my-2">
								<label for="name">Your Name</label>
								<input class="form-control" type="text" id="name" name="name" value="<?php echo $getData['name']; ?>">
							</div>
							
							<div class="custom form-group shadow my-2">
								<label for="email">Email Address</label>
								<input class="form-control" type="text" id="email" name="email" value="<?php echo $getData['email']; ?>">
							</div>
							
							<div class="custom form-group shadow my-2">
								<label for="skill">Skill</label>
								<input class="form-control" type="text" id="skill" name="skill" value="<?php echo $getData['skill']; ?>">
							</div>
							<input type="submit" name="submit" value="Update user" class="btn btn-primary w-100">
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