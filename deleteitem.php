<?php
$link=mysqli_connect("localhost","public","p@ssword","Project");
if(isset($_POST["id"])){
$itemid=$_POST['id'];
$query = "DELETE FROM items WHERE id={$_POST['id']} LIMIT 1";

mysql_query ($query,$link);
}
if (mysql_affected_rows() == 1) {

?>

    <strong>Contact Has Been Deleted</strong><br/><br/>
    <?php
} else {
  ?>

  <strong>Failed to delete item</strong><br/><br/>
  <?php
}
?>
