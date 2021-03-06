<?php
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: ' . $url);
    }
    session_start();
    
    if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
        header("Location: ./index.php"); // go to Login page
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Check In</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
<script>
$(document).ready(function(){
                  var original = $("#content").html();
                  $("#loader").load("header.php");
                  });
</script>
</head>
<body>
<header id="loader">
</header>
<style>
fieldset{
    text-align: center;
margin: auto;
}
</style>
<div id="content">
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-3"></div>
<div class="col-md-4 col-sm-4 col-xs-3">
<form method='POST' action='checkin.php'>
<h1>Check In</h1>
<?php
    if(!empty($_POST["verify"])){
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        $query1 = "UPDATE student_item_transaction
        SET checkin_time = NOW(), student_item_transaction.itemcondition_id = ? WHERE item_id = ? AND checkin_time IS NULL;";
        $statement1 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement1, $query1)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement1, "dd",$_POST["condition"],$_SESSION["itemidforupdate"]);
            
            
            /* execute query */
            mysqli_stmt_execute($statement1);
        }
        mysqli_stmt_close($statement1);
        mysqli_close($con);
        if($_SESSION["location"] == 1){
          $location = "Student Center";
        }else {
          $location = "Memorial Union";
        }
        mail($_SESSION["semail"], "You have successfully checked in an item", "THIS EMAIL IS AUTOMATICALLY GENERATED, Please do not reply to this email. Please address any concerns, in person, to the staff at the ".$location ." check out desk. The laptop you checked out in the ".$location." has been successfully returned. Sincerely, Missouri Student Unions");
        /* Navigate to transactions.php */
        header("Location: transactions.php");
    }
    else if(!empty($_POST["itemname"])){
        
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        $itemname = $_POST["itemname"];
        
        if (!$con) {
            echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
            echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
            echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
            exit;
        }
        $query0 = "SELECT id FROM item WHERE name = ?";
        $statement0 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement0, $query0)) {
            
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement0, "s", $itemname);
            
            
            /* execute query */
            mysqli_stmt_execute($statement0);
        }
        
        $result0 = mysqli_stmt_get_result($statement0);
        $row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
        if(empty($row0[0])){
         echo "<div class='alert alert-danger' role='alert'>There is no item with that name please enter a correct item name</div>";
            exit;
        }
        $itemid = $row0[0];
        $_SESSION["itemidforupdate"] = $itemid;
        mysqli_stmt_close($statement0);
        
        $query2 = "SELECT COUNT(*),student.name_first,student.name_last,student.email
        FROM student_item_transaction
        INNER JOIN student
        ON student_item_transaction.student_id = student.id
        WHERE item_id = ? AND checkin_time IS NULL;";
        $statement2 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement2, $query2)) {
											 
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement2, "d", $itemid);
            
            
            /* execute query */
            mysqli_stmt_execute($statement2);
        }
        $result2 = mysqli_stmt_get_result($statement2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
        if($row2[0] == 0){
        echo "<div class='alert alert-danger' role='alert'>This item is not currently checked out if you would like to check this item out please click<a href='checkout.php' class='alert-link'>here</a></div>";
            exit;
        }
        
        echo "<fieldset><p>Item Name:".$itemname."</p>";
        echo "<p>Student Name: ".$row2[1]." ".$row2[2]."</p>";
        $_SESSION["semail"] = $row2[3];
        mysqli_stmt_close($statement2);
        $query3 = "SELECT id,name FROM item_condition";
        $statement3 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement3, $query3)) {
            
            /* execute query */
            mysqli_stmt_execute($statement3);
        }
        
        $result3 = mysqli_stmt_get_result($statement3);
        echo "<select name='condition'>";
        
        while($row3 = mysqli_fetch_array($result3, MYSQLI_NUM)){
            
            echo "<option value='".$row3[0]."'>".$row3[1]."</option>";
            
        }
        echo "</select>";
        mysqli_stmt_close($statement3);
        mysqli_close($con);
								
        echo "<br/><br/><input name='verify' class='btn btn-primary' type='submit' value='Submit'></fieldset>";
    }
    else{
        ?>
<label>Enter in an item name:</label><input class="form-control" type='text' size='30' name='itemname'></input><br/><button type='submit' class='btn btn-primary'>Check In</button>
<?php
    }
    ?>
</form>
</div>
</div>
</div>
</body>


</html>
