<?php
session_start();

if($_SESSION["level"] < 1){
   header("location: home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Register</title>
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
<div id="content">
<form method="POST" action="register.php">
<h1>Register</h1>
<?php
    if(!empty($_POST["user"]) && !empty($_POST["password"])){
        
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        if (!$con) {
            echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
            echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
            echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
            exit;
        }
        $query0 = "INSERT INTO employee(username,hashed_pass,salt,name_first,name_last,email) VALUES (?,?,?,?,?,?);";
        $query1 = "INSERT INTO employee_has_permissions VALUES((SELECT id FROM employee where username = ?), ?);";
        $statement0 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement0, $query0)) {
            $salt = mt_rand();
            $hpass = password_hash($salt.$_POST["password"], PASSWORD_BCRYPT)  or die("bind param");
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement0, "ssdsss", $_POST["user"],$hpass,$salt, $_POST["firstname"],$_POST["lastname"],$_POST["email"]);
            
            /* execute query */
            mysqli_stmt_execute($statement0);
        }
        $result0 = mysqli_stmt_get_result($statement0);
        $row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
        $itemid = $row0[0];
        mysqli_stmt_close($statement0);
        $statement1 = mysqli_stmt_init($con);
        if (mysqli_stmt_prepare($statement1, $query1)) {
            //echo $_POST["user"].$_POST["level"];
            
            mysqli_stmt_bind_param($statement1, "sd", $_POST["user"],$_POST["level"]);
            
            /* execute query */
            mysqli_stmt_execute($statement1);
        }
        $result1 = mysqli_stmt_get_result($statement1);
        $row1 = mysqli_fetch_array($result1, MYSQLI_NUM);
        mysqli_stmt_close($statement1);
        
        mysqli_close($con);
    }
    
    
    else{
      ?>
      <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-3"></div>
      <div class="col-md-4 col-sm-4 col-xs-6" id="container">
       <label>First Name:</label><input class="form-control" type="text" name="firstname"></input><br/><label>Last Name:</label><input class="form-control" type="text" name="lastname"></input><br/><label>Username:</label><input type="text" class="form-control" name="user"></input><br/><label>Email:</label><input class="form-control" type="text" name="email"></input><br/><label>Password:</label><input class="form-control" type="text" name="password"/><br/><label>Access Level:</label>
      <select class="form-control" name="level">
      <?php
      $con= mysqli_connect("localhost","public","P@ssword","Project");
      $query1 = "SELECT id,name FROM employee_permissions";
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
      <br/><button type="submit" class="btn btn-primary">Register</button>
     <?php   
    }
    ?>
</form>
</div>
</div>
 </div>
 </div>
</body>


</html>
