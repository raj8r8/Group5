<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Login</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
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
