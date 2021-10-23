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
 <form method="POST" action="AddMatch.php">
 	<button type = "submit" name="Add">Add Match</button>		
 </form><br>

 <form method="_POST" action="UpdateMatch.php">
 	<button type="submit" name="update">Update Match data</button>
 </form><br>

 <form method="_POST" action="DeleteMatch.php">
 	<button type="submit" name="delete">Delete Match</button><br><br>
 </form>

 <?php 
 $sql = "SELECT * FROM match_";

 $result = mysqli_query($conn,$sql);

 if($result->num_rows > 0){

 	echo "
 	<table border = 2px solid> 
 	<tr>
 	<th>Match ID</th>
 	<th>Date</th>
 	<th>Time</th>
 	<th>Format</th>
 	<th>Stadium id</th>
 	<th>Event id</th>
 	</tr>";


 	while($row = $result->fetch_assoc()){


 		
 		$mid = $row["MATCH_ID"];
 		
 		$format = Format($conn,$mid);

 		echo "
 		<tr>
 		<td>".$mid."</td>
 		<td>".$row["DATE"]."</td>
 		<td>".$row["TIME"]."</td>
 		<td>".$format."</td>
 		<td>".$row["STADIUM_ID"]."</td>
 		<td>".$row["EVENT_ID"]."</td>

 		</tr>";	
 	}

 	echo "</table>";
 }

 if(isset($_POST['logout'])){
 	session_destroy();
 	header("location: AdminLogin.php");
 }




 function Format($conn,$mid){
 	$sql = "SELECT MATCH_ID from match_format where MATCH_ID = $mid";
 	$result =  mysqli_query($conn,$sql);

 	if(mysqli_num_rows($result) == 1){
 		$query = "SELECT FORMAT FROM match_format where MATCH_ID = $mid";
 		$run = mysqli_query($conn,$query)->fetch_array();
 		return $run[0];
 	}

 }



 ?>


</body>
</html>

