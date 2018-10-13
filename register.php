<?php
session_start();
include_once("includes/DBCon.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form id="register_form" action="register.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" name="FirstName" id="FirstName" tabindex="1" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" name="LastName" id="LastName" tabindex="2" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name="email" id="email" tabindex="3" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" name="password" id="password" tabindex="4" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" name="confirm_password" id="confirm_password" tabindex="5" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <input type="submit" name="register_submit" id="register-submit" tabindex="6" class="btn btn-primary btn-block" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
<?php
	global $con;
	
	if(isset($_POST['register_submit']))
	{
		//Check null or empty fields
		if(isset($_POST['FirstName']) && !empty($_POST['FirstName'])AND isset($_POST['LastName']) && !empty($_POST['LastName']) AND isset($_POST['email']) && !empty($_POST['email']))
		{
    $firstname = mysqli_real_escape_string($con,$_POST['FirstName']);
		$lastname = mysqli_real_escape_string($con,$_POST['LastName']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		$confirmpassword = mysqli_real_escape_string($con,$_POST['confirm_password']);
		$createddate = date("Y-m-d h:i:sa");
		}
		else
		{
			echo"<script> alert('Fields cannot be null or empty.')</script>";
			exit;
		}

		// Email format validation
		//if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
			// Return Error - Invalid Email
			echo"<script> alert('Invalid email address.')</script>";
			exit;
		}
		else
		{
			// Return Success - Valid Email
			// Check the Email availability
			$admin_query = "SELECT * FROM users	WHERE email = '$email'";
			$run = mysqli_query($con,$admin_query);
			if(mysqli_num_rows($run)>0)
			{
				echo"<script> alert('Email id already exist.')</script>";
				exit;
			}
		}
		
		//Check the password and confirm password are matched
		if($password != $confirmpassword)
		{
			echo"<script> alert('Password and Confirm Password is not match.')</script>";
			exit;
		}
		

		//Inserting record
			$hash = md5( rand(0,1000) );
			$usr = "INSERT INTO `users`(`user_type_id`, `FirstName`, `LastName`, `password`, `email`, `age`,
			 `city`, `created_date`, `last_access_date`, `user_status_id`, `hash`) VALUES
				(2,'$firstname','$lastname','$password','$email',NULL,NULL,'$createddate','$createddate',2,'$hash')";
					
			$run = mysqli_query($con, $usr);
			
			//Email
			$to      = $email; // Send email to our user
			$subject = 'Signup | Verification'; // Give the email a subject 
			$message = '
			
			Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
			
			------------------------
			Username: '.$email.'
			Password: '.$password.'
			------------------------
			
			Please click this link to activate your account:
			http://dating.360infotecs.com/verify.php?email='.$email.'&hash='.$hash.'
			
			'; // Our message above including the link
								
			$headers = 'From:noreply@dating.360infotecs.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send our email

			if($run){
				echo"<script> window.open('register-success.html','_self')</script>";
			}
			else
			{
				echo "Error: " . $usr . "<br>" . $con->error;
			}
		
	}	
?>