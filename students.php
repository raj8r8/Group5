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
		<title>All Items</title>
		<style>
		h1{
			text-align: center;
		}
		th{
			text-align: center;
		}

		td{
			text-align: center;
		}
		</style>
		</head>
		<body>
		<header id="loader">
		</header>
		<div id="content">
		<h1>All Waivers</h1>
<?php 
		
			$con= mysqli_connect("localhost","public","P@ssword","Project");
			
			if (!$con) {
				echo "<p>Error: Unable to connect to MySQL." . PHP_EOL."</p>";
				echo "<p>Debugging errno: " . mysqli_connect_errno() . PHP_EOL."</p>";
				echo "<p>Debugging error: " . mysqli_connect_error() . PHP_EOL."</p>";
				exit;
			    }
			$query = 'SELECT * FROM student;';
		//run the query
		$result=mysqli_query($con,$query);
		// Get number of columns from result
		$fieldinfo=mysqli_fetch_fields($result);
		//create table
		echo "<table class='table table-hover' id='items'><thead>";
		echo "<th>Edit</th>";
		//create the header for each column
		foreach ($fieldinfo as $value) {
			echo "<th>".$value->name."</th>";
		}
		echo "</thead><tbody>";
		//get each row
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			echo "<td><form method='POST' action='editStudent.php'><input type='hidden' name='id' value='".$row[0]."'/><input type='hidden' name='name' value=".$row[1]."/><input type='hidden' name='isBanned' value=".$row[5]."/><button type='submit' class='btn btn-info'>Edit</button></form></td>";
			//make each cell 
			foreach($row as $key => $var) {
				echo "<td>".$var."</td>";
			}
			echo "</tr>";
		}
		echo  "</tbody></table>";
		
		//free result
		mysqli_free_result($result);
		//close mysql connection
		mysqli_close($con);

		?>
		</div>
		</body>
		<script>
				$(document).ready(function(){
				var original = $("#content").html();
				$("#loader").load("header.html");
												 
				 $('#items').DataTable();
			});
				</script>
				
</body>
</html>
