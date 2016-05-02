<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<title>Check In</title>
<style>
#content{
width: 100%;
text-align: center;
}
</style>
<script>
$(document).ready(function(){
	var original = $("#content").html();
	$("#loader").load("header.html");
});
</script>
</head>
<body>
<header id="loader">
</header>
<div id="content">
<form method='POST' action='checkin.php'>
<h1>Check In</h1>
<?php
		if(!empty($_POST["itemid"])){
		 
				$con= mysqli_connect("localhost","public","P@ssword","Project");
				$itemname = $_POST["itemid"];
				if (!$con) {
						echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
						echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
						echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
						exit;
				}
				$query0 = "SELECT id FROM item WHERE name = ?";
							$statement0 = mysqli_stmt_init($con);
							if (mysqli_stmt_prepare($statement0, $query0)) {
								 
									/* bind parameters for markers */
									mysqli_stmt_bind_param($statement0, "s", $itemname);
									
									
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
							$result0 = mysqli_stmt_get_result($statement0);
							$row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
							$itemid = $row0[0];
							mysqli_stmt_close($statement0);
							
							$query1 = "UPDATE student_item_transaction SET checkin_time = NOW() WHERE item_id = ? AND checkin_time IS NULL;";
										$statement1 = mysqli_stmt_init($con);
										if (mysqli_stmt_prepare($statement1, $query1)) {
											 
												/* bind parameters for markers */
												mysqli_stmt_bind_param($statement1, "d", $itemid);
												
												
												/* execute query */
												mysqli_stmt_execute($statement1);
												if(mysqli_stmt_error($statement1) != ""){
							 
														echo "<p>Error because of ".mysqli_stmt_error($statement1)."</p>";
														exit;
												}
										}
										else{
											echo "<p>".mysqli_stmt_error($statement1)."</p>";
											
									}
										$result1 = mysqli_stmt_get_result($statement1);
										mysqli_stmt_close($statement0);
							

		}
		
		
		else{
				echo "<label>Enter in an item name:</label><input type='text' size='30' name='itemid'></input><br/><button type='submit' class='btn btn-default'>Check In</button>";
				
		}
		?>
</form>
</div>
</body>


</html>
