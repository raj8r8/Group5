<?php
    session_start();
  	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}   
    if(isset($_POST['submit'])) {
        $db = mysqli_connect("localhost", "public", "P@ssword", "Project")
        or die("Connect Error");
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $category = htmlspecialchars($_POST['category']);
        $condition = htmlspecialchars($_POST['condition']);
    if (!$con) {
				echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
				echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
				echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
				exit;
			    }
     $sql = "UPDATE item SET name = ? WHERE id=$id";
    if($stmt = $db->prepare($sql)){
        
        $stmt->bind_param('ss', $id, $name);
    
        $stmt->execute() or die("Execute error");
    }
        
    $sql2 = "UPDATE item_has_category SET name = ? WHERE item_id=$id";
    if($stmt2 = $db->prepare($sql2)){
        
        $stmt2->bind_param('s', $category);
    
        $stmt2->execute() or die("Execute error");
    }
        
    $sql3 = "UPDATE item_condition_update SET name = ? WHERE item_id=$id";
    if($stmt3 = $db->prepare($sql3)){
        
        $stmt3->bind_param('s', $condition);
    
        $stmt3->execute() or die("Execute error");
    }