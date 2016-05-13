<?php
    session_start();
  	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}   
    if(isset($_POST['submit'])) {
        $con = mysqli_connect("localhost", "public", "P@ssword", "Project");
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $isBanned = htmlspecialchars($_POST['ban_status']);
        
        if (!$con) {
        	echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
        	echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
        	echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
        	exit;
	    }
        $sql2 = "UPDATE student SET isBanned = ? WHERE id = ?;";
        $statement2 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement2, $sql2)) {
                         
                            /* bind parameters for markers */
                            mysqli_stmt_bind_param($statement2, "dd", $isBanned, $id);
                                                        /* execute query */
                            mysqli_stmt_execute($statement2);
                            if(mysqli_stmt_error($statement2) != ""){
                                echo "<p>Error because of ".mysqli_stmt_error($statement2)."</p>";
                                exit;
                            }
        } else {
            echo "<p>".mysqli_stmt_error($statement2)."</p>";    
        }

       	header("Location: students.php"); 
 }
?>