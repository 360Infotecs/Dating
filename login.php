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
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form id="login_form" action="login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name="username" id="username" tabindex="1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="password" id="password" tabindex="2" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <input type="submit" name="login_submit" id="login_submit" tabindex="4" class="btn btn-primary btn-block" value="Login">
        </form>
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

<?php
	if(isset($_POST['login_submit']))
	{
		$user_name = mysqli_real_escape_string($con,$_POST['username']);
		$user_pass = mysqli_real_escape_string($con,$_POST['password']);
		
		$encrypt = md5($user_pass);
		
		$admin_query = "SELECT *
						FROM users
						LEFT JOIN user_status ON users.user_status_id = user_status.id
						LEFT JOIN user_type ON users.user_type_id = user_type.id
						WHERE
						email = '$user_name' AND password = '$user_pass'";
		
		$run = mysqli_query($con,$admin_query);

		if(mysqli_num_rows($run)>0)
		{
			if(!empty($_POST["remember"])) {
				setcookie ("login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["login"])) {
					setcookie ("login","");
				}
				if(isset($_COOKIE["password"])) {
					setcookie ("password","");
				}
			}

			$_SESSION['UserName']= $user_name;
			while($row=mysqli_fetch_array($run))
			{
				$_SESSION['Age'] = $row['age'];
				$_SESSION['City']=$row['city'];
				$_SESSION['CreatedDate']=$row['created_date'];
				$_SESSION['Email']= $row['email'];
				$_SESSION['UserId']= $row['id'];
				$_SESSION['LastAccessDate']= $row['last_access_date'];
				$_SESSION['UserStatus']= $row['user_status'];
				$_SESSION['UserType']= $row['user_type'];
				$_SESSION['UserStatusId'] = $row['user_status_id'];
				$_SESSION['Hash'] = $row['hash'];
			}

			if($_SESSION['UserStatusId']==3)
			{
				echo"<script>alert('Your account is deleted.')</script>";
				session_destroy();
			}
			else if($_SESSION['UserStatusId']==2)
			{
				echo"<script>alert('Your account is disabled or not activated.')</script>";
				session_destroy();
			}
			else
			{
				if($_SESSION['Age']!=NULL && $_SESSION['City']!=NULL)
				{
					echo"<script>window.open('index.php','_self')</script>";
				}
				else
				{
					echo"<script>alert('Complete your profile to meet more partners.')</script>";
					echo"<script>window.open('UpdateProfile.php','_self')</script>";
				}
			}
		}
		else
		{
			echo"<script>alert('User name or Password is Incorrect')</script>";
			echo"<script>window.open('Login.php','_self')</script>";
		}				
	}
?>