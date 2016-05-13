<?php
    session_start();
$link=mysqli_connect("localhost","public","P@ssword","Project");

    $itemid= $_SESSION["deleteid"];
$query = "DELETE FROM item WHERE id = ?";

$statement = mysqli_stmt_init($link);

if(mysqli_stmt_prepare($statement,$query)){
  mysqli_stmt_bind_param($statement,"d",$itemid);

  mysqli_stmt_execute($statement);
  if(mysqli_stmt_error($statement) != ""){
      echo "<p>Error because of".mysqli_stmt_error($statement)."</p>";
  }
}
else{
  echo "<p>Error because of".mysqli_stmt_error($statement)."</p>";
}
mysqli_stmt_close($statement);
mysqli_close($link);
    unset($_SESSION["deleteid"]);
if(mysqli_stmt_error($statement)){
  echo "unable to delete this item";
}
else{
  header ("Location: ./items.php");
}
?>
