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
			<select name="location">
			<?php
				$con= mysqli_connect("localhost","public","P@ssword","Project");
				if (!$con) {
					echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
					echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
					echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
					exit;
				}
				
				$query1 = "SELECT id,name FROM location";
				$statement1 = mysqli_stmt_init($con);
				if (mysqli_stmt_prepare($statement1, $query1)) {
					
					/* execute query */
					mysqli_stmt_execute($statement1);
					if(mysqli_stmt_error($statement1) != ""){
						
						echo "<p>Error because of ".mysqli_stmt_error($statement1)."</p>";
						exit;
					}
				}
				else{
					echo "<p>".mysqli_stmt_error($statement1)."</p>";
					
				}
				$result1 = mysqli_stmt_get_result($statement1);
				
				
				while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){
					
					echo "<option value='".$row1[0]."'>".$row1[1]."</option>";
					
				}
				mysqli_stmt_close($statement1);
				?>
			</select><br/>
						<button type="submit">Submit</button>
			</form>

		</div>
  </body>
  </html>
