<?php
    session_start();

  	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}   
    
    $admin = "SELECT permission FROM employee WHERE username = $_SESSION['username']";
    $admin->bind_result("s", $permission);
    $admin->execute() or die("Execute error");
    if($permission = "admin"){
    if(isset($_POST['submit'])) {
        $db = mysqli_connect("localhost", "public", "P@ssword", "Project")
        or die("Connect Error");
    

    if (!$con) {
				echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
				echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
				echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
				exit;
			    }
    $sql = "UPDATE employee SET username = ?";
    if($stmt = $db->prepare($sql)){
        
        $stmt->bind_param('s', $username);
    
        $stmt->execute() or die("Execute error");
    }
    } 
    }

    else{
        echo "<h4>You do not have permission to make this change</h4>";
    }
?>