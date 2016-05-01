<!DOCTYPE html>
<html>
<head>
<title>Verifying login</title>

</head>
<?php
	$login_information = "Please enter username and password to login";
	$has_login = false;
	// start the session
	session_start();
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}

	// check the session variable, if exist, get them
	if(isset($_SESSION["username"]))
		$user_name = $_SESSION["username"];
//	if(isset($_SESSION["user_type"]))
	//	$user_type = $_SESSION["user_type"];

	if(isset($user_name))
		$has_login = true;

	else
	{
		// check if we have got someting from the html form
		if(isset($_POST['username']) || isset($_POST['password']))
		{
			$user_name = $_POST['username'];
			$password = $_POST['password'];

			$db = mysqli_connect("localhost", "root", "123456", "Project")
				or die("Connect Error " . mysqli_error($link));

			$sql_query = 'SELECT employee.salt, employee.hashed_pass, employee.id, employee.username, empolyee_has_permissions.permission_id FROM employee INNER JOIN employee_has_permissions on employee.id=employee_has_permissions.employee_id WHERE username = ?';
			if($stmt = $db->prepare($sql_query))
			{
				$stmt->bind_param("s", $user_name);
				$stmt->bind_result($salt, $pwhash, $user_type);
				$stmt->execute() or die("execute error");
			}
			// get the result
			$stmt->fetch();
			// chech the password validation
			if(password_verify($salt . $password, $pwhash))
			{
				$has_login = true;
				// store the login information to the session
				$_SESSION["username"] = $employee.username;
				$_SESSION["id"] = $employee.id;
				$_SESSION[level] = $employee_has_permissions.permission_id
			}
			else
				// username of password must be wrong
				$login_information = "Wrong username or password!";

			// close the database connection
			$db->close();
		}
	}

	// to determine what part it is going to load
	if($has_login) {
	// check the user type
	if($level == "2")
		header("location: topadminuser.php");
	else if($level == '1')
		header("location: adminuser.php");
	else if($level == '0')
		//header("location: user.php");
		header("location: checkout.php");
	} else {
?>

<body>
<div class="page-container">
	<div class="main_box">
		<div class="login_box">
			<div class="login_form">
				<form action="Login.php" id="login_form" method="post">
					<div class="form-group">
						<label for="j_username" class="t">Username:</label>
						<input id="username" value="" name="username" type="text" class="form-control x319 in"
						autocomplete="off">
					</div>
					<div class="form-group">
						<label for="j_password">Password:</label>
						<input id="password" value="" name="password" type="password">
					</div>
					　　
                        <input type="submit" value="Submit">

				</form>
			</div>
		</div>
	</div>
</div>

<?php
	echo $login_information;
}
?>
</body>
</html>
