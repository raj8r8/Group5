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
      <div class="row"><div class="col-md-4 col-sm-4 col-xs-3"></div>
      <div class="col-md-4 col-sm-4 col-xs-6">
        <h2>Create a Location</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <div class="row form-group">
              <input class='form-control' type="text" name="location" id="location" placeholder="Location Name">
          </div>
          <div class="row form-group">
              <input class=" btn btn-info" type="submit" name="submit" value="Submit item"/>
          </div>


        </form>
      </div>
    </div>

<?php
if(isset($_POST['submit'])) { // Was the form submitted?
$location = $_POST["location"];
  $link = mysqli_connect("localhost", "public", "P@ssword", "Project") or die ("Connection Error " . mysqli_error($link));
  $query = "INSERT INTO location VALUES (DEFAULT,?)";
  $statement0 = mysqli_stmt_init($link);
 if (mysqli_stmt_prepare($statement0, $query)) {
         
          /* bind parameters for markers */
          mysqli_stmt_bind_param($statement0, "s", $location);
          
          
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
    echo "<p>You have entered a new location named ".$location."</p>";
    mysqli_close($con);
}
?>
