  <?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
		$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header('Location: ' . $url);
	}
    
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { // if user is logged in
	    header("Location: ./checkout.php"); // go to checkout page
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<style>
		#content{
			width: 100%;
			text-align: center;
		}
		</style>
		 <link href="header.css" rel="stylesheet">
	</head>
	<body>
		<div id="header">
		<div id="title">
		<h1>Welcome to the Mizzou Item Management System</h1>
		</div>
			
		</div>

		<div id="content">
			<h1>Login</h1>
			<form method="POST" action="verifylogin.php" id="login_form" >
			<label>Username:</label>
			<input id="username" size="30" name="username" type="text">
			<br/>
			<label>Password:</label>
			<input id="password" size="30" name="password" type="text">	
			<br/>		　　
			<button type="submit">Submit</button>
			</form>

		</div>
  </body>
  </html>
