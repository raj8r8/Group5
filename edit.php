<?php
    session_start();
    ?>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
                  $("#loader").load("header.php");
                  });
</script>
<style>
h1{
    text-align: center;
}
#content{
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
<div class="col-md-4 col-sm-4 col-xs-6" id="container">
<h1>Edit An Item</h1>

<form action="item_edit.php" id="edit" method="POST">
<label>ID:</label><input class="form-control" type="text" name="id" readonly="readonly" value="<?=$_POST["id"]?>">
<br/>
<label>Name:</label><input class="form-control" type="text" name="name" value="<?=$_POST["name"]?>">
<br/>
<label>Condition:</label>
<div class="row form-group">
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
    mysqli_close($con);
    ?>
</select>
</div>
<div class="row form-group">
<br/>
<label>Category:</label>
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
    mysqli_stmt_close($statement0);
    mysqli_close($con);
    ?>
</select>
</div>

<br/>
<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
</div>
</body>

</html>
