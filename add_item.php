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
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
                  $("#loader").load("header.php");
                  });
</script>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
</head>
<body>
<header id="loader">
</header>

<div id="content">
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-3"></div>
<div class="col-md-4 col-sm-4 col-xs-6">
<h2>Add a New Item</h2>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
<div class="row form-group">
<label>Item Name:</label>
<input class='form-control' type="text" name="item" id="item" >
</div>
<div class="row form-group">
<label for="item category">Item Category</label>
<select class='form-control' name="item_category" id="item_category">
<?php
    $con= mysqli_connect("localhost","public","P@ssword","Project");
    if (!$con) {
        echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
        echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
        echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
        exit;
    }
    $query0 = "SELECT id,name FROM item_category";
    $statement0 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement0, $query0)) {
        
        /* execute query */
        mysqli_stmt_execute($statement0);
    }
    
    $result = mysqli_stmt_get_result($statement0);
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<option value='".$row[0]."'>".$row[1]."</option>";
        
    }
    mysqli_stmt_close($statement0); ?>
</select>
</div>
<div class="row form-group">
<label for "item condition">Item Condition</label>
<select class='form-control' name="item_condition" id= "item_condition">
<?php
    $con= mysqli_connect("localhost","public","P@ssword","Project");
    if (!$con) {
        echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
        echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
        echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
        exit;
    }
    
    $query1 = "SELECT id,name FROM item_condition";
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
    ?>
</select>
</div>
<div class="row form-group">
<label for "item location">Item Location</label>
<select class='form-control' name="item_location" id="location">
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
    ?>
</select>
</div>
<div class="row form-group">
<input class=" btn btn-primary" type="submit" name="submit" value="Add Item"/>
</div>
</form>
<?php
    if(isset($_POST["item"])){
        $item = $_POST["item"];
        $category = $_POST["item_category"];
        $condition = $_POST["item_condition"];
        $location = $_POST["item_location"];
        
        echo "<p>Item".$item."Category".$category."Condition".$condition."Location".$location."</p>";
        
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        if (!$con) {
            echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
            echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
            echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
            exit;
        }
        
        $query1 = "INSERT INTO item VALUES(DEFAULT,?,?)";
        $statement1 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement1, $query1)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement1, "sd", $item,$location);
            /* execute query */
            mysqli_stmt_execute($statement1);
        }
        $result1 = mysqli_stmt_get_result($statement1);
        
        mysqli_stmt_close($statement1);
        
        $query2 = "INSERT INTO item_has_category
        VALUES((SELECT id FROM item WHERE name = ?),?);
        ";
        $statement2 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement2, $query2)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement2, "sd", $item,$category);
            /* execute query */
            mysqli_stmt_execute($statement2);
        }
        $result2 = mysqli_stmt_get_result($statement2);
        
        mysqli_stmt_close($statement2);
        $query3 = "INSERT INTO item_condition_update
        VALUES((SELECT id FROM item WHERE name = ?),?);
        ";
        $statement3 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement3, $query3)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement3, "sd", $item,$condition);
            /* execute query */
            mysqli_stmt_execute($statement3);
        }
        $result2 = mysqli_stmt_get_result($statement3);
        
        mysqli_stmt_close($statement3);
        mysqli_close($con);
        header("Location: items.php");
    }
    ?>
</div>
</div>
</div>
</body>

</html>
