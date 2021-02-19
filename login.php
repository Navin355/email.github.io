<?php include 'connection.php' ?>

<?php

if(isset($_POST['login']))
{	

	if($_POST['email']=="")
	{
		$email_error = 'Please Fill email Field.';
	}else{		
		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		{
			$email_error = 'Please Enter Valid Email Id.';
		}
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
	

	if( !isset($pass_error) && !isset($email_error) )
	{       
             
         $email = $_POST['email']; 
         $pass =$_POST['pass'];    
       
         	$esql = "SELECT * FROM email WHERE Email='$email' AND status='active'";
         	$equery = mysqli_query($conn,$esql);
         	$row = mysqli_fetch_assoc($equery);
         	if(!mysqli_num_rows($equery)>0)
         	{
         		?>
     	    	   <script>
     	    	   	 alert("Incorrect User Name or Password.");    	   	 
     	    	   </script>
     	    	<?php
         	}else{
         	   $pass_decode = password_verify($pass,($row['Pass']));        		
         		
         	    if(!$pass_decode){
         	    	?>
	     	    	   <script>
	     	    	   	 alert("Incorrect User Name or Password.");    	   	 
	     	    	   </script>
	     	    	<?php
         	    }else{
         	    	?>
         	    	   <script>
         	    	   	 alert("Login Successfully.");  
         	    	   	 location.replace('view_data.php');  	   	 
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
			<h4 class="card-title mt-3 text-center">Login Account</h4>
			<p class="text-center">Get started with your free account</p>
			<p>
				<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
				<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
			</p>
			<p class="divider-text">
		        <span class="bg-light">OR</span>
		    </p>
		    <div>
		    	<p class="bg-success text-weight p-2">
		    		<?php if(isset($_SESSION['msg'])){echo $_SESSION['msg'];} ?>
		    	</p>
		    </div>
			<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">			

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
				    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
		        <input name="pass" class="form-control" placeholder="Enter password" type="password">
		        <h6 style="color:red;">	        	
		        	<?php if(isset($pass_error)){ echo $pass_error;}?>
		        </h6>
		    </div> <!-- form-group// -->
		                                     
		    <div class="form-group">
		        <button name="login" type="submit" class="btn btn-primary btn-block"> Login  </button>
		    </div> <!-- form-group// -->      
		    <p class="text-center">Dont't Have an account? <a href="registration.php">Register</a> </p>                                                                 
		</form>
		</article>
	</div> <!-- card.// -->

</div> 
<!--container end.//-->


<?php include 'footer.php' ?>


