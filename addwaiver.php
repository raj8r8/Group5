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

<title>Add Waiver</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
<script>
    $(document).ready(function(){
        $("#header").load("header.html");
     });
</script>
</head>
<body>
<header id="header"></header>
<div id="content">
<form method='POST' action='addwaiver.php'>
<h1>Add Waiver</h1>
<?php
    if(!empty($_POST["studentid"]) && (!empty($_POST["hasBikeShare"]) || !empty($_POST["hasJournalism"])) ) {
     
        $con= mysqli_connect("localhost","public","P@ssword","Project");
        $studentid = $_POST["studentid"];
        $hasBikeShare = $_POST["hasBikeShare"]; // waiver_id == 1
        $hasJournalism = $_POST["hasJournalism"]; // waiver_id == 2

        if (!$con) {
            echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
            echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
            echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
            exit;
        }

        if ( isset($_POST["hasBikeShare"]) && $_POST["hasBikeShare"] == true ) {
          $sql = "INSERT INTO student_has_waiver (student_id, waiver_id) VALUES ('$studentid', '1')";

          $statement1 = mysqli_stmt_init($con);
          if (mysqli_stmt_prepare($statement1, $sql)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement1, "sd", $item,$location);
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

          if ($result1 == true) {
              echo "$studentid submitted a bike waiver";
          } else {
              echo "Error: " . $sql . "<br>" . $con->error;
          }
        }

        if ( isset($_POST["hasJournalism"]) && $_POST["hasJournalism"] == true ) {
          $sql = "INSERT INTO student_has_waiver (student_id, waiver_id) VALUES ('$studentid', '2')";

          $statement2 = mysqli_stmt_init($con);
          if (mysqli_stmt_prepare($statement2, $sql)) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($statement2, "sd", $item,$location);
            /* execute query */
            mysqli_stmt_execute($statement2);
            if(mysqli_stmt_error($statement2) != ""){
              
              echo "<p>Error because of ".mysqli_stmt_error($statement2)."</p>";
              exit;
            }
          }
          else{
            echo "<p>".mysqli_stmt_error($statement2)."</p>";
            
          }

          $result2 = mysqli_stmt_get_result($statement2);

          if ($result2 == true) {
              echo "$studentid submitted a journalism equipment waiver";
          } else {
              echo "Error: " . $sql . "<br>" . $con->error;
          }
        }

        mysqli_close($con);
    }
    
    
    else {
?>
      <label>Enter a student ID:</label><input type='text' size='30' name='studentid'><br/>
      <div style='display:inline-block; margin-top: 10px; border-bottom: 1px solid black;'>Select waiver(s):</div><br/>
      <div style='display:inline-block; text-align: left;'>
        <input type='checkbox' name='hasBikeShare'><label>Bike Share Program</label><br/>
        <input type='checkbox' name='hasJournalism'><label>Journalism Equipment</label><br/>
      </div><br/>
      <button style='margin-top: 30px;' type='submit' class='btn btn-default'>Add</button>
<?php
        
    }
?>
</form>
</div>
</body>


</html>
