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
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form id="ResetPassword" action="forgot-password.php" role="form" autocomplete="off" method="post">
          <div class="form-group">
            <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address">
          </div>
          <input name="ResetSubmit" class="btn btn-primary btn-block" id="ResetSubmit" value="Reset Password" type="submit">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="login.php">Login Page</a>
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
include_once("includes/DBCon.php");
$hash ="";
if(isset($_POST['ResetSubmit']))
{
  $email = mysqli_real_escape_string($con,$_POST['email']);
  
  $query = "SELECT hash FROM users WHERE email='$email'";
  
  $run = mysqli_query($con,$query);
  if(mysqli_num_rows($run)>0)
  {
    while($row=mysqli_fetch_array($run))
    {
      $hash = $row['hash'];
    }

    //Email
			$to      = $email; // Send email to our user
			$subject = 'Reset Password | Verification'; // Give the email a subject 
			$message = '
			
			Your password has been reset, you can create new password by pressing the url below.
			
			
			Please click this link to reset your account password:
			http://dating.360infotecs.com/reset-password.php?email='.$email.'&hash='.$hash.'
			
			'; // Our message above including the link
								
			$headers = 'From:noreply@dating.360infotecs.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send our email
      //Email end
      echo"<script> alert('Password reset link has been sent to your email.')</script>";
      //echo"<script> alert('Password reset link has been sent to your email.\n Check your mail and follow the instructions.')</script>";
      echo"<script> window.open('index.php','_self')</script>";
  }
  else
  {
    echo"<script> alert('Invalid email address.')</script>";
    exit;
  }
}

?>