<?php include 'connection.php' ?>
<?php
	$sql = "SELECT * FROM email";
	$query = mysqli_query($conn,$sql);
?>
<?php include 'header.php' ?>
<main class="p-2">
	<table class="table table-bordered table-striped">
		<thead>
			<th>NO</th>
			<th>Name</th>			
			<th>Email</th>			
			<th>Mobile</th>
			<th>Action</th>			
		</thead>
		<tbody>
			<?php if(mysqli_num_rows($query)>0 ) : $count = 1 ;?>
				<?php while($row=mysqli_fetch_assoc($query)) : ?>
					<tr>
						<td><?php echo $count++; ?></td>
						<td><?php echo $row['Name']; ?></td>						
						<td><?php echo $row['Email']; ?></td>						
						<td><?php echo $row['Mobile']; ?></td>
						<td>
							<a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
								Update
							</a>
						</td>
						<td>
							<a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
								Delete
							</a>
						</td>

					</tr>
				<?php endwhile;?>
				<?php else : ?>
					<tr>
						<td>No Record Found</td>
					</tr>
				<?php endif;?>
		</tbody>
	</table>
</main>

<?php include 'footer.php' ?>