<?php
if(isset($_POST['resetsubmit']) && $_POST['email'] && $_POST['NewPassword'])
{
  $email=$_POST['email'];
  $pass=$_POST['NewPassword'];
include_once("includes/DBCon.php");

  $query ="UPDATE users SET password ='$pass' where email='$email'";
  $result = mysqli_query($con,$query);
  if($result)
    {
        echo "<script>alert('Password reset Sucsessfull!')</script>";
        echo "<script>window.open('login.php','_self')</script>";
    }	
    else
    {
        echo "Error: " .$sql . "<br>" . $con->error;
    }	
}
?>