<?php 
include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="AddPB_Team.php">
		<button type = "submit" name="Add">Add</button>		
	</form><br>

	<form method="_POST" action="UpdatePB_Team.php">
		<button type="submit" name="update">Update</button>
	</form><br>

	<form method="_POST" action="DeletePB_Team.php">
		<button type="submit" name="delete">Delete</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM played_by";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
			<th>Team ID</th>
			<th>Match ID</th>
			<th>Wickets</th>
			<th>Score</th>
			<th>Result</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["TEAM_ID"]."</td>
			<td>".$row["MATCH_ID"]."</td>
			<td>".$row["WICKETS"]."</td>
			<td>".$row["SCORE"]."</td>
			<td>".$row["RESULT"]."</td>
			</tr>";	
		}

		echo "</table>";
	}
?>

</body>
</html>