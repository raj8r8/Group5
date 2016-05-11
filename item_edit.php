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
        $category = htmlspecialchars($_POST['item_category']);
        $condition = htmlspecialchars($_POST['item_condition']);
    if (!$con) {
				echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
				echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
				echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
				exit;
			    }
     $sql = "UPDATE item SET name = ? WHERE id=?;";
    		$statement1 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement1, $sql)) {
                     
                        /* bind parameters for markers */
                        mysqli_stmt_bind_param($statement1, "sd",$name, $id);
                        
                        
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
        
    $sql2 = "UPDATE item_has_category SET item_category_id = ? WHERE item_id=?;";
    $statement2 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement2, $sql2)) {
                     
                        /* bind parameters for markers */
                        mysqli_stmt_bind_param($statement2, "dd",$category,$id);
                        
                        
                        /* execute query */
                        mysqli_stmt_execute($statement2);
                        if(mysqli_stmt_error($statement2) != ""){
     
                                echo "<p>Error because of ".mysqli_stmt_error($statement2)."</p>";
                                exit;
                        }
    } 
    else{
            echo "<p>".mysqli_stmt_error($stmt2)."</p>";
            
    }  
    $sql3 = "UPDATE item_condition_update SET item_condition_id = ? WHERE item_id= ?;";
    $statement3 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement3, $sql3)) {
                     
                        /* bind parameters for markers */
                        mysqli_stmt_bind_param($statement3, "dd",$condition,$id);
                        
                        
                        /* execute query */
                        mysqli_stmt_execute($statement3);
                        if(mysqli_stmt_error($statement3) != ""){
     
                                echo "<p>Error because of ".mysqli_stmt_error($statement3)."</p>";
                                exit;
                        }
    }
    else{
            echo "<p>".mysqli_stmt_error($statement3)."</p>";
            
    }
   	header("Location: items.php"); 
 }
?>