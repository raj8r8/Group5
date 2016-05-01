<!DOCTYPE html>
<html>
<head>
<title>Verifying login</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
	<?php
	
	$login_information = "Please enter username and password to login";
	$has_login = false;
	$showLogin = false;
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
	
	if(isset($_SESSION["user_type"]))
		$user_type = $_SESSION["user_type"];
	
	if(isset($user_name)) {
		$has_login = true;
	} else {
		// check if we have got someting from the html form
		if (isset($_POST['username']) || isset($_POST['password'])) {
			$user_name = $_POST['username'];
			$password = $_POST['password'];

			$db = mysqli_connect("localhost", "root", "123456", "Project")
				or die("Connect Error " . mysqli_error($link));
			
			$sql_query = 'SELECT employee.salt, employee.hashed_pass, employee.id, employee.username, empolyee_has_permissions.permission_id FROM employee INNER JOIN employee_has_permissions on employee.id=employee_has_permissions.employee_id WHERE username = ?';
			if($stmt = $db->prepare($sql_query)) {
				$stmt->bind_param("s", $user_name);
				$stmt->bind_result($salt, $pwhash, $user_type);
				$stmt->execute() or die("execute error");
			}

			// get the result
			$stmt->fetch();
			
			// chech the password validation
			if(password_verify($salt . $password, $pwhash)) {
				$has_login = true;
				// store the login information to the session
				
				$_SESSION["username"] = $user_name;
				$_SESSION["id"] = $employee.id;
				$_SESSION["user_type"] = $user_type;
				
			} else {
				// username of password must be wrong
				$login_information = "Wrong username or password!";
			}
				
			// close the database connection
			$db->close();
			
			
		}
	}

	// to determine what part it is going to load
	if($has_login) {
		// check the user type
		if($user_type == "2") {
			header("location: topadminuser.php");
		} else if($user_type == '1') {
			header("location: adminuser.php");
		} else if($user_type == '0') {
			//header("location: user.php");
			header("location: checkout.php");
		} else {
			$showLogin = true;
		}
	} else {
		$showLogin = true;
	}

	if ( $showLogin ) {
?>
<div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-3"></div>
        <div class="col-md-4 col-sm-4 col-xs-6">
          <h2>Employee Login</h2>
          <form action="verifylogin.php" method="POST">
            <div class="row form-group">
                <input class='form-control' type="text" name="username" placeholder="username">
            </div>
            <div class="row form-group">
                <input class='form-control' type="password" name="password" placeholder="password">
            </div>

            <div class="row form-group">
                <input class=" btn btn-info" type="submit" name="login" value="Login"/>
            </div>
          </form>
        </div>
      </div>
  </div>

<?php
		echo $login_information;
	}
?>

</body>
</html>
