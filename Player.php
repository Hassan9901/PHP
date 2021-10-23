<?php 

include("connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])	?>">
 		<button name="logout">Log Out</button>
 	</form>
 -->
	<form method="POST" action="AddPlayer.php">
		<button type = "submit" name="Add">Add Player</button>		
	</form><br>

	<form method="_POST" action="UpdatePlayer.php">
		<button type="submit" name="update">Update Player data</button>
	</form><br>

	<form method="_POST" action="DeletePlayer.php">
		<button type="submit" name="delete">Delete Player</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM player";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
		<th>Player ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>DOB</th>
		<th>Age</th>
		<th>Role</th>
		<th>Team Id</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["PLAYER_ID"]."</td>
			<td>".$row["FIRST_NAME"]."</td>
			<td>".$row["LAST_NAME"]."</td>
			<td>".$row["EMAIL"]."</td>
			<td>".$row["DOB"]."</td>
			<td>".$row["AGE"]."</td>
			<td>".$row["TYPE"]."</td>
			<td>".$row["TEAM_ID"]."</td>

			</tr>";	
		}

		echo "</table>";
	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

	// if(isset($_POST['Add'])){
	// 	include('AddAdmin.php');		
	// }
	// if (isset($_POST['update'])) {
	// 	include('UpdateAdmin.php');
	// }


	?>


</body>
</html>

