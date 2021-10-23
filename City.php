<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddCity.php">
		<button type = "submit" name="Add">Add Citiy</button>		
	</form><br>

	<form method="_POST" action="UpdateCity.php">
		<button type="submit" name="update">Update City data</button>
	</form><br>

	<form method="_POST" action="DeleteCity.php">
		<button type="submit" name="delete">Delete City</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM city";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px> 
		<tr>
			<th>City ID</th>
			<th>City Name</th>
			<th>Country ID</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["CITY_ID"]."</td>
			<td>".$row["CITY_NAME"]."</td>
			<td>".$row["COUNTRY_ID"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>