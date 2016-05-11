<?php
$link=mysqli_connect("localhost","public","P@ssword","Project");
if(isset($_POST["id"])){
$itemid = $_POST['id'];
$query = "DELETE FROM item WHERE id = ?";

$statement = mysqli_stmt_init($link);

if(mysqli_stmt_prepare($statement,$query)){
  mysqli_stmt_bind_param($statement,"d",$itemid);
  mysqli_stmt_execute($statement);
}

}
if (mysqli_affected_rows($statement) == 1) {
?>
