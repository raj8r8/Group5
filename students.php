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
		<title>All Students</title>
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
		<h1>All Students</h1>
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

		$fieldName = array();

		foreach ($fieldinfo as $value) { // re-arrange array
			if ( $value->name == "id" ) {
				$fieldName[0] = "ID"; // 0th item
			} elseif ( $value->name == "username") {
				$fieldName[4] = "Username"; // 4th item
			} elseif ( $value->name == "email") {
				$fieldName[3] = "Email"; // 3rd item
			} elseif ( $value->name == "name_first") {
				$fieldName[1] = "First Name"; // 1st item
			} elseif ( $value->name == "name_last") {
				$fieldName[2] = "Last Name"; // 2nd item
			} elseif ( $value->name == "isBanned") {
				$fieldName[5] = "Banned"; // 5th item
			} else {
				//array_push($fieldName, $value->name);
			}
		}

		foreach( $fieldName as $key => $name ) {
			echo "<th>".$name."</th>";
		}

		echo "<th>ID</th>";

		echo "</thead><tbody>";
		//get each row
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			echo "<td><form method='POST' action='editStudent.php'><input type='hidden' name='id' value='".$row[0]."'/><input type='hidden' name='name' value=".$row[1]."/><input type='hidden' name='isBanned' value=".$row[5]."/><button type='submit' class='btn btn-info'>Edit</button></form></td>";
			//make each cell

			echo "<td>".$row[0]."</td>"; // id
			echo "<td>".$row[3]."</td>"; // first name
			echo "<td>".$row[4]."</td>"; // last name
			echo "<td>".$row[2]."</td>"; // email
			echo "<td>".$row[1]."</td>"; // username
			echo "<td>".($row[5] == 0 ? "No" : "Yes")."</td>"; // isBanned

			$numOfRows = sizeof($row);

			if ( $numOfRows > 6 ) { // handle remaining rows
				for ( $i = 6; $i < $numOfRows; $i++ ) {
					echo "<td>".$row[$i]."</td>";
				}
			}

			echo "</tr>";
		}

		echo "</tbody></table>";
		
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
