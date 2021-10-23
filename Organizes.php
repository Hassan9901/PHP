<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddOrganizer.php">
		<button type = "submit" name="Add">Add Organizer</button>		
	</form><br>

	<form method="_POST" action="UpdateOrganizer.php">
		<button type="submit" name="update">Update Organizer data</button>
	</form><br>

	<form method="_POST" action="DeleteOrganizer.php">
		<button type="submit" name="delete">Delete Organizer</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM organizes";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
			<th>Admin ID</th>
			<th>Event ID</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["ADMIN_ID"]."</td>
			<td>".$row["EVENT_ID"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>