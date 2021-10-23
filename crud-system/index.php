<?php 
	include 'lib/config.php';
	include 'lib/database.php';
	include 'inc/header.php';
?>
<?php 
/**
 * Fetching Data from database
 */
	$db 	= new Database();
	$query 	= "SELECT * FROM tbl_user";
	$data 	= $db->select($query);

/**
 * Delete Data by ID
 */
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
if (isset($_GET['action']) && $_GET['action']=='delete') {
	$delete_query 	= "DELETE FROM tbl_user WHERE id = $id";
	$db->delete($delete_query);
}

/**
 * Showing success message
 */

	$msg = "";
	if(isset($_GET['msg'])){
		$msg = "<div class='btn btn-success btn-sm d-block mb-1'>".$_GET['msg']."</div>";
	}

 ?>
<main>
	<div class="container my-3">
		<div class="row">
			<div class="col-md-12">
				<div class="shadow mb-3">
					<div class="card-header">
						<h2 class="d-inline-block">User List</h2>
						<span class="float-end">
							<a class="btn btn-primary btn-sm" href="form.php">Add user</a>
						</span>
					</div>
					<div class="card-body">
						<?php echo $msg; ?>
						<table class="table rounded">
							<thead>
								<tr class="table-dark">
									<th>Serial</th>
									<th>Name</th>
									<th>Email</th>
									<th>Skill</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($data) : 
									while($row = $data->fetch_assoc()) :
								?>
								<tr class="">
									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['skill']; ?></td>
									<td>
										<a 
											href="update.php?id=<?php echo $row['id']; ?>" 
											class="btn btn-primary btn-sm">
											Edit
										</a>
										<a 
										href="index.php?action=delete&id=<?php echo $row['id']; ?>" 
										class="btn btn-danger btn-sm">x</a>
									</td>
								</tr>
							<?php endwhile; else: ?>
								<h3>No data found</h3>
							<?php endif; ?>
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