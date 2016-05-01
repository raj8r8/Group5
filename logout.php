<!DOCTYPE html>
<html>
<head>
<title>Logout</title>
</head>

<body>
<?php
	session_start();

	// remove all session variables
	session_unset();
	// destroy the session
	session_destroy();
	// get back to the main page
	header("location: index.php");
?>
</body>
</html>
