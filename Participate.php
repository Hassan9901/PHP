<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddParticipent.php">
		<button type = "submit" name="Add">Add Participent</button>		
	</form><br>

	<form method="_POST" action="UpdateParticipent.php">
		<button type="submit" name="update">Update Participent data</button>
	</form><br>

	<form method="_POST" action="DeleteParticipent.php">
		<button type="submit" name="delete">Delete Participent</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM participate";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
			<th>Team ID</th>
			<th>Event ID</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["TEAM_ID"]."</td>
			<td>".$row["EVENT_ID"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>