<?php
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: ' . $url);
    }

    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { // if user is logged in
        // check the user type
        if( $_SESSION["level"] == "2"){
            header("Location: topadminuser.php");
        }
        else if( $_SESSION["level"] == '1'){
            header("Location: adminuser.php");
        }
        else if( $_SESSION["level"] == '0'){
            header("Location: home.php");
        
        
    }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-3"></div>
<div class="col-md-4 col-sm-4 col-xs-6" id="container">
<?php
if(isset($_SESSION["logininfo"])){
    echo $_SESSION["logininfo"];
unset($_SESSION["logininfo"]);
    
}
?>
<h1>Login</h1>
<form method="POST" action="verifylogin.php" id="login_form" >
<label>Username:</label>
<input id="username" class="form-control" size="30" name="username" type="text">
<br/>
<label>Password:</label>
<input id="password" class="form-control" size="30" name="password" type="password">
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
                }
				$result1 = mysqli_stmt_get_result($statement1);


				while($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){

                    echo "<option value='".$row1[0]."'>".$row1[1]."</option>";

                }
				mysqli_stmt_close($statement1);
				mysqli_close($con);
				?>
</select><br/><br/>

<button class="btn btn-primary" type="submit">Submit</button>

</form>
</div>
</div>
</div>
</div>
</body>
</html>
