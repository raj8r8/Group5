<?php
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
  header("Location: ./index.php"); // go to Login page
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Admint</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
<script>
    $(document).ready(function(){
        $("#header").load("header.php");
     });
</script>
</head>
<body>
<header id="header"></header>
<style>
  fieldset{
    text-align: center;
    margin: auto;
  }
</style>
<div id="content">
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-3"></div>
<div class="col-md-4 col-sm-4 col-xs-3">
<form method='POST' action='checkout.php'>
<h1>I'm the Captain now...</h1>
<?php
	// check the session variable, if exist, get them
	if(isset($_SESSION["username"]))
		$user_name = $_SESSION["username"];
	if(isset($_SESSION["level"]))
		$level = $_SESSION["level"];

	if(isset($user_name))
	{
		// check if it is super admin user
		if($level == "2")
		{
	

			$manage = new Manage("localhost", "root", "123456", "Project");
			$manage->connect();
			$manage->disconnect();
		}
		// check if it is admin user
		else
			if($level == "0")
				header("location: home.php");
			else
				echo "Login in error";
	}
	else
	{
		echo "Please enter username and password to login<br />";
		echo "Press here to <a href='index.php?'>HomePage!</a>";
	}
?>
</body>
</html>
