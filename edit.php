<?php
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
    header("Location: ./index.php"); // go to Login page
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
                    $("#loader").load("header.html");            
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
    <h1>Edit An Item</h1>
            <form action="item_edit.php" id="edit" method="POST">
                <label>ID:</label><input type="text" name="id" readonly="readonly" value="<?=$_POST["id"]?>">
                <br/>
               <label>Name:</label><input type="text" name="name">
                 <br/>
                <label>Condition:</label>
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
    </select>
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
                if(mysqli_stmt_error($statement0) != ""){
        											 
                    echo "<p>Error because of ".mysqli_stmt_error($statement0)."</p>";
                    exit;
                }
            }
            else{
                echo "<p>".mysqli_stmt_error($statement0)."</p>";
                
            }
            
            $result = mysqli_stmt_get_result($statement0);
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                echo "<option value='".$row[0]."'>".$row[1]."</option>";
                
            }
            mysqli_stmt_close($statement0); ?>
        </select>
        
                 <br/>
            <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
    
</html>
