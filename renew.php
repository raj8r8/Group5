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
		  <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
		<title>Renew</title>
		<style>
		#content{
			width: 100%;
			text-align: center;
			}
		</style>
		<script>
		$(document).ready(function(){
			$("#loader").load("header.php");
											 
		});
		</script>
		</head>
		<body>
		<header id="loader">
		</header>
		<div id="content">
		<div class="row">
<div class="col-md-4 col-sm-4 col-xs-3"></div>
		<div class="col-md-4 col-sm-4 col-xs-6" id="container">
		<form method='POST' action='renew.php'>
		<h1>Renew</h1>
		
<?php 
		if(isset($_POST["name"])){
			$con= mysqli_connect("localhost","public","P@ssword","Project");
			
			if (!$con) {
				echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
				echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
				echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
				exit;
			 }
			$query0 = "SELECT item.id,item_category.id FROM item
			INNER JOIN item_has_category
			ON item.id = item_has_category.item_id
			INNER JOIN item_category
			ON item_category.id = item_has_category.item_category_id
			WHERE item.name = ?";
			$statement0 = mysqli_stmt_init($con);
			if (mysqli_stmt_prepare($statement0, $query0)) {
				
				/* bind parameters for markers */
				mysqli_stmt_bind_param($statement0, "s", $_POST["name"]);
				
				/* execute query */
				mysqli_stmt_execute($statement0);
			}
			
			$result0 = mysqli_stmt_get_result($statement0);
			$row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
			if($row0[1] != 1){
				echo "<div class='alert alert-danger' role='alert'>This item is not eligible to be renewed, only laptops can be renewed please go back and reconfirm the item name</div>";
				exit;
			}
			if(empty($row0[0])){
			 echo "<div class='alert alert-danger' role='alert'>There is no item with that name please enter a correct item name</div>";
				exit;
			}
			else{
				$itemid = $row0[0];

			}
			$query = "UPDATE student_item_transaction 
			SET due_time = due_time + INTERVAL 2 HOUR
			WHERE item_id = ? AND checkin_time IS NULL;";
			$statement = mysqli_stmt_init($con);
			
			if(mysqli_stmt_prepare($statement,$query)){
				mysqli_stmt_bind_param($statement,"d",$itemid);
				mysqli_stmt_execute($statement);
				if(mysqli_stmt_affected_rows($statement) != 1){
					echo "<div class='alert alert-danger' role='alert'>This item is either not currently checked, please check the item name and try again</div>";
					exit;

				}
				mysqli_stmt_close($statement);
			}
			mysqli_close($con);
			
			header("Location: transactions.php");
		}
		else {
			?>
		<label>Enter in an item name:</label><input class="form-control" type='text' size='30' name='name'></input><br/><button type='submit' class='btn btn-primary'>Renew</button>	
<?php
		}						
?>
</form>
</div>
</div>
</div>
		</body>
				
</body>
</html>


