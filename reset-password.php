<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Reset Password</title>
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
      <div class="card-header">Login</div>
      <div class="card-body">

<?php
if($_GET['email'] && $_GET['hash'])
{
  $email = mysqli_real_escape_string($con,$_GET['email']); // Set email variable
   echo '<script>alert("'.$email.'");</script>';
  $hash = mysqli_real_escape_string($con,$_GET['hash']); // Set hash variable
   echo "<script>alert('3')</script>";
  include_once("includes/DBCon.php");

  $query ="SELECT email, hash FROM users WHERE email='".$email."' AND hash='".$hash."'";
  $search = mysqli_query($con,$query);
  if(mysqli_num_rows($search )>0)
    {
    ?>


        <form nane ="PasswordReset" id="PasswordReset" action="submit_new.php" role="form" autocomplete="off" method="post">
        <input type="hidden" name="email" value="<?php echo $email;?>">
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" tabindex="1" type="password" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input class="form-control" id="ConfirmNewPassword" name="ConfirmNewPassword" placeholder="Confirm New Password" tabindex="2" type="password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <input type="submit" name="resetsubmit" id="resetsubmit" tabindex="4" class="btn btn-primary btn-block" value="Login">
        </form>

<?php
  }
}
?>



        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
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

