<?php
    session_start();
    if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
        header("Location: ./index.php"); // go to Login page
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Checkout</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
<script>
$(document).ready(function(){
                  $("#header").load("header.php");
                  });
</script>
</head>
<body>
<header id="header"></header>
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
<form method='POST' action='checkout.php'>
<?php
    if(!empty($_SESSION["isBanned"])){
        echo "<div class='alert alert-danger' role='alert'>Student ".$_SESSION["sname"]." is currently banned and can not check out items please try a different student</div>";
        unset($_SESSION['isBanned']);
        unset($_SESSION["sname"]);
        exit;
        
    }
    ?>
<h1>Checkout</h1>
<?php
    if(!empty($_POST["verify"])){
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        
        $categoryid = $_SESSION["categoryid"];
        $itemid = $_SESSION["itemid"];
        $studentid = $_SESSION["studentid"];
        switch($categoryid){
            case 1:
                $query2 = "INSERT INTO student_item_transaction
                VALUES(DEFAULT,?,?,?,?,?,NOW(),NULL, NOW() + INTERVAL 2 HOUR,0)";
                break;
            case 2:
                $query2 = "INSERT INTO student_item_transaction
                VALUES(DEFAULT,?,?,?,?,?,NOW(),NULL,CONCAT(CURDATE(), ' 23:45:00'),0)";
                break;
            case 3:
                $query2 = "INSERT INTO student_item_transaction
                VALUES(DEFAULT,?,?,?,?,?,NOW(),NULL,CONCAT(CURDATE(), ' 23:00:00'),0)";
                break;
        }
        
        
        $statement2 = mysqli_stmt_init($con);
        
        if (mysqli_stmt_prepare($statement2, $query2)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement2, "ddddd", $studentid,$_SESSION["location"],$_SESSION["id"],$_SESSION["conditionid"],$itemid);
            
            /* execute query */
            mysqli_stmt_execute($statement2);
            mysqli_stmt_close($statement2);
        }
        mysqli_close($con);
       
        header("Location: transactions.php");
        
    }
    else if(!empty($_POST["studentid"]) && !empty($_POST["itemid"])){
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        $studentid = $_POST["studentid"];
        $_SESSION["studentid"] = $studentid;
        $itemname = $_POST["itemid"];
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
        $itemid = $row0[0];
        if(empty($itemid)){
      echo "<div class='alert alert-danger' role='alert'>There is no item with that name please enter a correct item name</div>";
            exit;
        }
        $_SESSION["itemid"] = $itemid;
        
        mysqli_stmt_close($statement0);
        $query4 = "SELECT COUNT(*) FROM student_item_transaction
        WHERE checkin_time IS NULL AND item_id = ?;";
        $statement4 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement4, $query4)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement4, "d", $itemid);
            
            
            /* execute query */
            mysqli_stmt_execute($statement4);
        }
        $result4 = mysqli_stmt_get_result($statement4);
        $row4 = mysqli_fetch_array($result4, MYSQLI_NUM);
        if($row4[0] != 0){
           echo "<div class='alert alert-danger' role='alert'>This item is currently checked out if you would like to check this item in please click<a href='checkin.php' class='alert-link'>here</a></div>";

            exit;
        }
        
        
        
        $query = "SELECT item_category.id,item.name,item_category.name
        FROM item_has_category
        INNER JOIN item ON
        item.id = item_has_category.item_id
        INNER JOIN item_category
        ON item_category.id = item_has_category.item_category_id
        WHERE item.id = ?";
        $statement = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement, $query)) {
            
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement, "d", $itemid);
            
            
            /* execute query */
            mysqli_stmt_execute($statement);
        }
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $categoryid = $row[0];
        $_SESSION["categoryid"] = $categoryid;
        echo "<fieldset><p>Item Name: ".$row[1]."</p>";
        echo "<p>Item Category Name: ".$row[2]."</p>";
        mysqli_stmt_close($statement);
        
        $query3 = "SELECT name_first, name_last,isBanned
        FROM student
        WHERE id = ?;";
        $statement3 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement3, $query3)) {
            
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement3, "d", $studentid);
            
            
            /* execute query */
            mysqli_stmt_execute($statement3);
        }
        $result3= mysqli_stmt_get_result($statement3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_NUM);
        if(!isset($row3[0]) || !isset($row3[1])){
            echo "<div class='alert alert-danger' role='alert'>There is currently no student with that id please enter in a student id that is valid</div>";
            
            exit;
        }
        $_SESSION["isBanned"] = $row3[2];
        $_SESSION["sname"] = $row3[0]." ".$row3[1];
        echo "<p>Student Name: ".$row3[0]." ".$row3[1]."</p><input name='verify' class='btn btn-primary' type='submit' value='Submit'></fieldset>";
        
        
        $query1 = "SELECT item_condition.id FROM item_condition_update
        INNER JOIN item
        ON item.id = item_condition_update.item_id
        INNER JOIN item_condition
        ON item_condition_update.item_condition_id = item_condition.id
        WHERE item.id = ?";
        $statement1 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement1, $query1)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement1, "d", $itemid);
            
            /* execute query */
            mysqli_stmt_execute($statement1);
            $result1 = mysqli_stmt_get_result($statement1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_NUM);
            $condtionid = $row1[0];
            $_SESSION["conditionid"] = $condtionid;
            mysqli_stmt_close($statement1);
        }
        mysqli_close($con);
        
    }
    
    else{
        ?>
<label>Enter in an item name:</label><input class="form-control" type='text' size='30' name='itemid'></input><br/><label>Enter in a student ID:</label><input type='text' class="form-control" size='30' name='studentid'/><br/><button type='submit' class='btn btn-primary'>Check Out</button>
<?php
    }
    ?>
</form>
</div>
</div>
</div>
</body>


</html>
