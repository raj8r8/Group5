<?php
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
		 mysqli_connect("localhost","jaylee109","Airforce1" "Project");
		 or die ('Cannot connect to database');

		 $itemcategories = mysql_query("SELECT id,name FROM item_category")
		 or die(mysql_error());

		 while($itemcategory = mysql_fetch_array($itemcategories))
		 {
			 $item_id = $itemcategory['id'];
			 $item_cat=$itemcategory['name'];
			 $item_block .= '<OPTION value="'.$item_id.'">'.$item_cat.'</OPTION>';
		 }

		 $conditions = mysql_query("SELECT id,name FROM item_condition");
		 or die(mysql_error());

		 while($itemcondition = mysql_fetch_array($conditions))
		 {
			 $cond_id = $itemcondition['id'];
			 $item_cond = $itemcondition['name'];
			 $cond_block .= '<OPTION value="'.$cond_id.'">'.$item_cond.'</OPTION>';
		 }
		/* $result = $conn->query("Select id, name from table");

		 echo "<html>";
		 echo "<body>";
		 echo "<select name='id'>";

		 while ($row = $result->fetch_assoc()) {

			 	unset($id, $name);
				$id = $row['id'];
				$name = $row['name'];
				echo '<option value="'.$id.'">'.$name.'</option>';
		 }
		 echo "</select>";
		 echo "</body>";
		 echo "</html>"; */
?>
<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3"></div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<h2>Add an item</h2>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<div class="row form-group">
								<input class='form-control' type="text" name="item" id="item" placeholder="item">
						</div>
						<div class="row form-group">
							<label for="item category">Item Category</label>
								<select class='form-control' name="item_category" id="item_category">
									<?php echo $item_block; ?>
								</select>
						</div>
						<div class="row form-group">
							<label for "item condition">Item Condition</label>
								<select class='form-control' name="item condition" id= "item_condition">
									<?php echo $cond_block; ?>
								</select>
						</div>
						<div class="row form-group">
							<label for "item location">Item Location</label>
								<select class='form-control' name="item location" id="location">
								<?php echo $loca_block; ?>
								</select>
						</div>
						<div class="row form-group">
								<input class=" btn btn-info" type="submit" name="submit" value="Submit item"/>
						</div>

					</form>
				</div>
			</div>
			<?php
				if(isset($_POST['submit'])) { // Was the form submitted?

					$link = mysqli_connect("localhost", "jaylee109", "Airforce1", "Project") or die ("Connection Error " . mysqli_error($link));
					$query = "INSERT INTO item(id,name,location_id) VALUES (DEFAULT,'item',1)";
					$query = "SELECT id FROM item WHERE name ='item'";
					$query = "INSERT INTO item_has_category VALUES(SELECT id FROM item WHERE name = 'item','item_condition')"
					$query = "INSERT INTO item_has_category(item_id) SELECT id FROM item WHERE name = 'item'";
					$query = "UPDATE item_has_category SET item_category_id = '1' WHERE item_id = 'DEFAULT'";
					if ($stmt = mysqli_prepare($link, $query)) {
						if(mysqli_stmt_execute($stmt)) {
							echo "h4>Success</h4>";
						} else {
							echo "<h4>Failed</h4>";
						}
						$result = mysqli_stmt_get_result($stmt);
					} else {
						die("prepare failed");
					}
				}
			?>
		</div>
	</body>
</html>
