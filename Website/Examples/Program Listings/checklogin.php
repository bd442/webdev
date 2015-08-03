<?php
//connect to database
include ("dbcon.php");
// username and password sent from form
$username=$_POST['username'];
$password=$_POST['password'];

//To protect from MySQL injection
$username=stripslashes($username);
$password=stripslashes($password);

//verify username and password
$query= "SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysql_query($query);
$count=mysql_num_rows($result);

//create session
if($count==1)
{
	session_start();
	$_SESSION ['username']=$username;
	$_SESSION ['password']=$password;
	header("location:index.php");	//Direct to the main page
}
else{
	session_start();
	$_SESSION['errormsg'] = "login failed";
	header("location:Main_login.php"); //Remain on the login page
	
	
	
}
?>