<?php include 'connection.php' ?>
<?php 

if(isset($_GET['token']))
{
	$token = $_GET['token'];
	$upd = "UPDATE email set status='active' WHERE token='$token'";
	$query = mysqli_query($conn,$upd);

	if($query)
	{
		if(isset($_SESSION['msg']))
		{
			$_SESSION['msg'] = "Account Update Successfully.";
			header('location:login.php');
		}else{
			$_SESSION['msg'] = "You are Logout.";
			header('location:login.php');
		}
	}else{
		$_SESSION['msg'] = "Account not Updated.";
			header('location:registration.php');
	}
}

?>