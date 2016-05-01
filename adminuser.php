<!DOCTYPE>
<html>
<head>

<title>Admin</title>
<style type="text/css">
body {
	background-color: #00CCFF;
}
</style>
</head>

<body>
<?php
	session_start();
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}
	// check the session variable, if exist, get them
	if(isset($_SESSION["username"]))
		$user_name = $_SESSION["username"];
	if(isset($_SESSION["user_type"]))
		$user_type = $_SESSION["user_type"];

	if(isset($user_name))
	{
		// check if it is regular user
		if($user_type == "admin")
		{
			echo "<table width='100%' align='center'>";
  			echo "<tr>";
  	 	 	echo "<td align='right' style='color: #C15BAF; font-size: 24px;'>Welcome Admin! Press here to <a href='logout.php'>logout!</a></td>";
  			echo "</tr>";
			echo "</table>";


			$manage = new Manage("localhost", "root", "123456", "Project");
			$manage->connect();
			$manage->disconnect();
		}
		// check if it is admin user
		else
			if($level == "0")
				header("location: user.php");
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
