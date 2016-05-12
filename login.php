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
          <form action="verifylogin.php" method="POST">
            <div class="row form-group">
                <input class='form-control' type="text" name="username" placeholder="username">
            </div>
            <div class="row form-group">
                <input class='form-control' type="password" name="password" placeholder="password">
            </div>

            <div class="row form-group">
                <input class=" btn btn-info" type="submit" name="login" value="Login"/>
            </div>
            <select name="location">
            <?php
              $con= mysqli_connect("localhost","public","P@ssword","Project");
              if (!$con) {
                echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
                echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
                echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
                exit;
              }
              
              $query1 = "SELECT id,name FROM location";
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
          </form>
        </div>
      </div>
  </div>
</body>

</html>
