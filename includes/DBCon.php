<?php

$sname = "localhost";
$username = "Dating360Admin";
$password = "360DatingPassword";
$dbname = "360dating";
// Create connection
$con = new mysqli($sname, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
//else
//{
//	echo('Success!');
//}
?>