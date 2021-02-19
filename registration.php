<?php include 'connection.php' ?>

<?php

if(isset($_POST['submit']))
{
	if($_POST['name']=="")
	{
		$name_error = 'Please Fill Name Field.';
	}else{
		$ptn = '/^[a-zA-Z ]+$/';
		if(!preg_match($ptn,$_POST['name']))
		{
			$name_error = 'Please Enter Valid Character.';
		}
	}

	if($_POST['email']=="")
	{
		$email_error = 'Please Fill email Field.';
	}else{		
		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		{
			$email_error = 'Please Enter Valid Email Id.';
		}
	}

	if($_POST['mobile']=="")
	{
		$mobile_error = 'Please Fill Mobile No Field.';
	}

	if($_POST['pass']=="")
	{
		$pass_error = 'Please Fill Password Field.';
	}else{
		$len = strlen($_POST['pass']);
		if($len<3 || $len>16)
		{
			$pass_error = 'Please Enter Character between 3 to 16.';
		}
	}

	if($_POST['cpass']=="")
	{
		$cpass_error = 'Please Fill Confirm Password Field.';
	}else{		
		if($_POST['cpass'] != $_POST['pass'])
		{
			$cpass_error = 'Confirm Password Field Did Not Match.';
		}
	}	

	if(!isset($name_error) && !isset($pass_error) && !isset($cpass_error) && !isset($mobile_error) && !isset($email_error) )
	{
         $name =mysqli_real_escape_string($conn,$_POST['name']);
         $email = mysqli_real_escape_string($conn,$_POST['email']);          
         $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
         $pass =mysqli_real_escape_string($conn,password_hash($_POST['pass'], PASSWORD_BCRYPT)); 
         $token = bin2hex(random_bytes(15));     
         $status = 'inactive';
         	
         	$esql = "SELECT * FROM email WHERE Email='$email'";
         	$equery = mysqli_query($conn,$esql);
         	if(mysqli_num_rows($equery)>0)
         	{
         		$email_error = "This Email Id Already Exists";
         	}else{         		
         		
         	    $isql = "INSERT INTO `email`(`Name`, `Email`, `Mobile`, `Pass`, `token`, `status`) VALUES ('".$name."','".$email."','".$mobile."','".$pass."','".$token."','".$status."')";
         	    $iquey = mysqli_query($conn,$isql);
         	    if($iquey){
         	    	$subject = "Email Activation";
         	    	$body = "Hi, $name. Click here too activate your account http://localhost/email/activate.php?token=$token";
         	    	$sender_email = "From: greenentp23@gmail.com";
         	    	if(mail($email, $subject, $body, $sender_email))
         	    	{
         	    		$_SESSION['msg'] = "Check your mail to activate your account $email";
         	    		header('location:login.php');
         	    	}else{
         	    		echo "Email sending failed..";
         	    	}
         	    }else{
         	    	?>
         	    	   <script>
         	    	   	 alert("Failed Insert Data.Please Try again.");    	   	 
         	    	   </script>
         	    	<?php
         	    }

         	}         
	}
}

?>

<?php include 'header.php' ?>


	<div class="card bg-light">
		<article class="card-body" style="max-width: 500px; margin-left: 500px;">
			<h4 class="card-title mt-3 text-center">Create Account</h4>
			<p class="text-center">Get started with your free account</p>
			<p>
				<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
				<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
			</p>
			<p class="divider-text">
		        <span class="bg-light">OR</span>
		    </p>
			<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

			<div class="form-group input-group">
				<div class="input-group-prepend">
				    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
				 </div>
		        <input name="name" class="form-control" placeholder="Full name" type="text">

		        <h6 style="color:red;">	        	
		        	<?php if(isset($name_error)){ echo $name_error;}?>
		        </h6>
		    </div> <!-- form-group// -->

		    <div class="form-group input-group">
		    	<div class="input-group-prepend">
				    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
				 </div>
		        <input name="email" class="form-control" placeholder="Email address" type="email">
		        <h6 style="color:red;">	        	
		        	<?php if(isset($email_error)){ echo $email_error;}?>
		        </h6>
		    </div> <!-- form-group// -->

		    <div class="form-group input-group">
		    	<div class="input-group-prepend">
				    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
				</div>				
		    	<input name="mobile" class="form-control" placeholder="Phone number" type="number">
		    	<h6 style="color:red;">	        	
		        	<?php if(isset($mobile_error)){ echo $mobile_error;}?>
		        </h6>
		    </div> <!-- form-group// -->
		   

		    <div class="form-group input-group">
		    	<div class="input-group-prepend">
				    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
		        <input name="pass" class="form-control" placeholder="Create password" type="password">
		        <h6 style="color:red;">	        	
		        	<?php if(isset($pass_error)){ echo $pass_error;}?>
		        </h6>
		    </div> <!-- form-group// -->

		    <div class="form-group input-group">
		    	<div class="input-group-prepend">
				    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
		        <input name="cpass" class="form-control" placeholder="Repeat password" type="password">
		        <h6 style="color:red;">	        	
		        	<?php if(isset($cpass_error)){ echo $cpass_error;}?>
		        </h6>
		    </div> <!-- form-group// -->                                      
		    <div class="form-group">
		        <button name="submit" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
		    </div> <!-- form-group// -->      
		    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
		</form>
		</article>
	</div> <!-- card.// -->

</div> 
<!--container end.//-->


<?php include 'footer.php' ?>


