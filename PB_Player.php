<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddPB_Player.php">
		<button type = "submit" name="Add">Add</button>		
	</form><br>

	<form method="_POST" action="UpdatePB_Player.php">
		<button type="submit" name="update">Update</button>
	</form><br>

	<form method="_POST" action="DeletePB_Player.php">
		<button type="submit" name="delete">Delete</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM plays";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
			<th>Match ID</th>
			<th>Player ID</th>
			<th>Runs Scored</th>
			<th>Wickets Taken</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["MATCH_ID"]."</td>
			<td>".$row["PLAYER_ID"]."</td>
			<td>".$row["RUNS"]."</td>
			<td>".$row["WICKETS"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>