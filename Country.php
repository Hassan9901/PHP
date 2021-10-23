<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddCountry.php">
		<button type = "submit" name="Add">Add Country</button>		
	</form><br>

	<form method="_POST" action="UpdateCountry.php">
		<button type="submit" name="update">Update Country data</button>
	</form><br>

	<form method="_POST" action="DeleteCountry.php">
		<button type="submit" name="delete">Delete Country</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM country";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
			<th>Country ID</th>
			<th>Country Name</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["COUNTRY_ID"]."</td>
			<td>".$row["COUNTRY_NAME"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>