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
        //var original = $("#content").html();
        $("#header").load("header.php");
     });
</script>
</head>
<body>
<header id="header"></header>
<div id="content">
<form method='POST' action='checkout.php'>
<h1>Checkout</h1>
<?php
    if(!empty($_POST["studentid"]) && !empty($_POST["itemid"])){
     
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        $studentid = $_POST["studentid"];
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
                  if(mysqli_stmt_error($statement0) != ""){
         
                      echo "<p>Error because of ".mysqli_stmt_error($statement0)."</p>";
                      exit;
                  }
              }
              else{
                echo "<p>".mysqli_stmt_error($statement0)."</p>";
                
            }
              $result0 = mysqli_stmt_get_result($statement0);
              $row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
              $itemid = $row0[0];
              mysqli_stmt_close($statement0);
              
              
        $query = "SELECT item_category.id FROM item_has_category INNER JOIN item ON item.id = item_has_category.item_id INNER JOIN item_category ON item_category.id = item_has_category.item_category_id WHERE item.id = ?";
        $statement = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement, $query)) {
           
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement, "d", $itemid);
            
            
            /* execute query */
            mysqli_stmt_execute($statement);
            if(mysqli_stmt_error($statement) != ""){
   
                echo "<p>Error because of ".mysqli_stmt_error($statement)."</p>";
                exit;
            }
        }
        else{
          echo "<p>".mysqli_stmt_error($statement)."</p>";
          
      }
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $categoryid = $row[0];
        mysqli_stmt_close($statement);
        
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
            if(mysqli_stmt_error($statement1) != ""){
                echo "<p>Error because of ".mysqli_stmt_error($statement1)."</p>";
                exit;
            }
            $result1 = mysqli_stmt_get_result($statement1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_NUM);
            $condtionid = $row1[0];
            mysqli_stmt_close($statement1);
        }
        else{
          echo "<p>".mysqli_stmt_error($statement1)."</p>";
          
      }
      echo "<p>".$categoryid."</p>";
      switch($categoryid){
        case 1:
         $query2 = "INSERT INTO student_item_transaction
        VALUES(DEFAULT,?,1,1,?,?,NOW(),NULL, NOW() + INTERVAL 2 HOUR,0)";
        break;
        case 2:
          $query2 = "INSERT INTO student_item_transaction
          VALUES(DEFAULT,?,1,1,?,?,NOW(),NULL,CONCAT(CURDATE(), ' 23:45:00'),0)";
          break;
          case 3:
            $query2 = "INSERT INTO student_item_transaction
            VALUES(DEFAULT,?,1,1,?,?,NOW(),NULL,CONCAT(CURDATE(), ' 23:00:00'),0)";
            break;
      }
        
 
        $statement2 = mysqli_stmt_init($con);
   
        if (mysqli_stmt_prepare($statement2, $query2)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement2, "ddd", $studentid,$condtionid,$itemid);
            
            /* execute query */
            mysqli_stmt_execute($statement2);
            if(mysqli_stmt_error($statement2) != ""){
                echo "<p>Error because of ".mysqli_stmt_error($statement2)."</p>";
                exit;
            }
            //echo "<p>".mysqli_stmt_affected_rows($statement2)."</p>";
            mysqli_stmt_close($statement2);
            
            /* Navigate to transactions.php */
            header("Location: /transactions.php");
            
        }
        else{
          echo "<p>".mysqli_stmt_error($statement2)."</p>";
          
      }
        mysqli_close($con);
    }
    
    
    else{
        echo "<label>Enter in an item name:</label><input type='text' size='30' name='itemid'></input><br/><label>Enter in a student ID:</label><input type='text' size='30' name='studentid'/><br/><button type='submit' class='btn btn-default'>Check Out</button>";
        
    }
    ?>
</form>
</div>
</body>


</html>
