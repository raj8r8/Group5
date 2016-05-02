<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	  
	session_start();
	
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
		header("Location: ./index.php"); // go to Login page
	}
?>
<html>
  <head>
  <!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
  </head>
  <body>
    <div class="container">
      <div class="row"><div class="col-md-4 col-sm-4 col-xs-3"></div>
      <div class="col-md-4 col-sm-4 col-xs-6">
        <h2>Create a Location</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <div class="row form-group">
              <input class='form-control' type="text" name="New Location" id="location" placeholder="Location Name">
          </div>
          <div class="row form-group">
              <input class=" btn btn-info" type="submit" name="submit" value="Submit item"/>
          </div>


        </form>
      </div>
    </div>

<?php
if(isset($_POST['submit'])) { // Was the form submitted?

  $link = mysqli_connect("localhost", "jaylee109", "Airforce1", "Project") or die ("Connection Error " . mysqli_error($link));
  $query = "INSERT INTO location('name') VALUES ('location')";
  if ($stmt = mysqli_prepare($link, $query)) {
    if(mysqli_stmt_execute($stmt)) {
      echo "h4>Success</h4>";
    } else {
      echo "<h4>Failed</h4>";
    }
    $result = mysqli_stmt_get_result($stmt);
  } else {
    die("prepare failed");
  }
}
?>
