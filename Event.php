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
	<form method="POST" action="AddEvent.php">
		<button type = "submit" name="Add">Add Event</button>		
	</form><br>

	<form method="_POST" action="UpdateEvent.php">
		<button type="submit" name="update">Update Event data</button>
	</form><br>

	<form method="_POST" action="DeleteEvent.php">
		<button type="submit" name="delete">Delete Event</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM Event_";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){
		
		echo "
		<table border = 2px solid> 
		<tr>
		<th>Event ID</th>
		<th>Event Name</th>
		<th>Year</th>
		<th>Format</th>
		<th>Country id</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["EVENT_ID"]."</td>
			<td>".$row["EVENT_NAME"]."</td>
			<td>".$row["YEAR"]."</td>
			<td>".$row["FORMAT"]."</td>
			<td>".$row["COUNTRY_ID"]."</td>

			</tr>";	
		}

		echo "</table>";
	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}



	?>


</body>
</html>

