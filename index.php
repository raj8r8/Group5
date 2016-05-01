  <?php
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
      $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      header('Location: ' . $url);
      //exit;
    }
?>

<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
		<script>
		$(document).ready(function(){
	          $("#header").load("header.php");
	          $("#content").load("verifylogin.php");
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
		<header id="header"></header>
		<div id="content"></div>
  </body>
  </html>
