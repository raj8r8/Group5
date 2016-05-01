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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3"></div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<h2>Employee Login</h2>
					<form action="VerifyLogin.php" method="POST">
						<div class="row form-group">
								<input class='form-control' type="text" name="username" placeholder="username">
						</div>
						<div class="row form-group">
								<input class='form-control' type="password" name="password" placeholder="password">
						</div>

						<div class="row form-group">
								<input class=" btn btn-info" type="submit" name="login" value="Login"/>
						</div>
					</form>
				</div>
			</div>
    </div>
  </body>
  </html>
