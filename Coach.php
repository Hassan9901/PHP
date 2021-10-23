<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddCoach.php">
		<button type = "submit" name="Add">Add Coach</button>		
	</form><br>

	<form method="_POST" action="UpdateCoach.php">
		<button type="submit" name="update">Update Coach data</button>
	</form><br>

	<form method="_POST" action="DeleteCoach.php">
		<button type="submit" name="delete">Delete Coach</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM coach";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px> 
		<tr>
			<th>Coach ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["COACH_ID"]."</td>
			<td>".$row["FIRST_NAME"]."</td>
			<td>".$row["LAST_NAME"]."</td>
			<td>".$row["EMAIL"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>