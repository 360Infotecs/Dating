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
      <div class="card-header"><center><h1 style="color:green;">Congratulations!</h1></center></div>
      <div class="card-body">
        <form id="register_form" action="register.php" method="post">
         
       
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <center>
				<?php
					include_once("includes/DBCon.php");
								if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
					{
						// Verify data
						$email = mysqli_real_escape_string($con,$_GET['email']); // Set email variable
						$hash = mysqli_real_escape_string($con,$_GET['hash']); // Set hash variable
						$query ="SELECT email, hash, user_status_id 
								FROM users WHERE email='".$email."' AND hash='".$hash."' AND user_status_id='2'";
						$search = mysqli_query($con,$query);
					
						if(mysqli_num_rows($search )>0)
						{
							// We have a match, activate the account
							$qrystring = "UPDATE users SET user_status_id='1' 
										WHERE email='".$email."' AND hash='".$hash."' AND user_status_id='2'";
					
							$runqry = mysqli_query($con, $qrystring);
							if($runqry)
							{
							echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
							}
							else
							{
							// No match -> invalid url or account has already been activated.
							echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
							}
						}
					}
					else
					{
						// Invalid approach
						echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
					}
					
					?>
				</center>
              </div>
            </div>
          </div>
          <a href="index.php" class="btn btn-primary btn-block">Back to home</a>
        </form>
       <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a>-->
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