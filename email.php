<?php
			$con= mysqli_connect("localhost","public","P@ssword","Project");
$query = "SELECT * FROM emailqueue";
			$statement = mysqli_stmt_init($con);
			if (mysqli_stmt_prepare($statement, $query)) {
					/* execute query */
					mysqli_stmt_execute($statement);
			}
			$result= mysqli_stmt_get_result($statement);
			while($row = mysqli_fetch_row($result)) {
				mail($row[1], "Your item is now over due", "THIS EMAIL IS AUTOMATICALLY GENERATED, Please do not reply to this email. Please address any concerns, in person, to the staff at the Memorial Union check out desk. The item you checked out is now over due, please return it to the same location that you check it out ASAP. Sincerely, Missouri Student Unions","From: umcsasunions@missouri.edu");
			
			$query1 = "DELETE FROM emailqueue WHERE id = ?";
			$statement1 = mysqli_stmt_init($con);
			if (mysqli_stmt_prepare($statement1, $query1)) {
				mysqli_stmt_bind_param($statement1,"d",$row[0]);
					/* execute query */
					mysqli_stmt_execute($statement1);
			}
				mysqli_stmt_close($statement1);
			}
			
			mysqli_stmt_close($statement);
					mysqli_close($con);
?>