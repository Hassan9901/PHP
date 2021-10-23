<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddStadium.php">
		<button type = "submit" name="Add">Add Stadium</button>		
	</form><br>

	<form method="_POST" action="UpdateStadium.php">
		<button type="submit" name="update">Update Stadium data</button>
	</form><br>

	<form method="_POST" action="DeleteStadium.php">
		<button type="submit" name="delete">Delete Stadium</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM Stadium";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px> 
		<tr>
			<th>Stadium ID</th>
			<th>Stadium Name</th>
			<th>Crowd Capacity</th>
			<th>City ID</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["STADIUM_ID"]."</td>
			<td>".$row["STADIUM_NAME"]."</td>
			<td>".$row["CROWD_CAPACITY"]."</td>
			<td>".$row["CITY_ID"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>