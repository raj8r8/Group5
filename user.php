<!DOCTYPE html>
<html>
<head>
<title>Employee</title>
</script>
<style type="text/css">
body {
	background-color: #00CCFF;
}
</style>
</head>

<body>

<?php	include "./PHP_Classes/MyUser.php";
	session_start();
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}
	// check the session variable, if exist, get them
	if(isset($_SESSION["username"]))
		$user_name = $_SESSION["username"];
	if(isset($_SESSION["level"]))
		$user_type = $_SESSION["level"];

	if(isset($user_name))
	{
		// check if it is regular user
		if($0 == "user")
		{
			echo "<table width='100%' align='center'>";
  			echo "<tr>";
  	 	 	echo "<td align='right' style='color: #C15BAF; font-size: 24px;'>Welcome " . $user_name. "! Press here to <a href='logout.php'>logout!</a></td>";
  			echo "</tr>";
			echo "</table>";
		}
		// check if it is admin user
		else if($user_type == "1")
		{
					header("location: adminuser.php");
		}

			else{
				echo "Login in error";
			}
		// show user business plan information
		$myUser = new MyUser("localhost", "root", "123456", "Project");
		$myUser->connect();
		// start with a new line


		//disconnect the database;
		$myUser->disconnect();
?>
<?php
	}
	// it must be the wrong login information
	else
	{
		echo "Please enter username and password to login<br />";
		echo "Press here to <a href='index.php'>HomePage!</a>";
	}
?>
</body>
</html>
