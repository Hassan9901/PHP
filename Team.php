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
 <form method="POST" action="AddTeam.php">
 	<button type = "submit" name="Add">Add Team</button>		
 </form><br>

 <form method="_POST" action="UpdateTeam.php">
 	<button type="submit" name="update">Update Team data</button>
 </form><br>

 <form method="_POST" action="DeleteTeam.php">
 	<button type="submit" name="delete">Delete Team</button><br><br>
 </form>

 <?php 
 $sql = "SELECT * FROM team";

 $result = mysqli_query($conn,$sql);

 if($result->num_rows > 0){

 	echo "
 	<table border = 2px solid> 
 	<tr>
 	<th>Team ID</th>
 	<th>Team Name</th>
 	<th>Matches Played</th>
 	<th>Won</th>
 	<th>Lost</th>
 	<th>Points</th>
 	<th>Country Id</th>
 	<th>Coach d</th>
 	<th>Player Id</th>
 	</tr>";

 	while($row = $result->fetch_assoc()){

 		$tid = $row["TEAM_ID"];

 		$matches_played = Matches_Played($conn,$tid);
 		$matches_won = Matches_Won($conn,$tid);
 		$matches_lost = Matches_Lost($conn,$tid);
 		$points = Points($conn,$tid);

 		echo "
 		<tr>
 		<td>".$row["TEAM_ID"]."</td>
 		<td>".$row["TEAM_NAME"]."</td>
 		<td>".$matches_played."</td>
 		<td>".$matches_won."</td>
 		<td>".$matches_lost."</td>
 		<td>".$points."</td>
 		
 		<td>".$row["COUNTRY_ID"]."</td>
 		<td>".$row["COACH_ID"]."</td>
 		<td>".$row["PLAYER_ID"]."</td>

 		</tr>";	
 	}
 	echo "</table>";
 }

 if(isset($_POST['logout'])){
 	session_destroy();
 	header("location: AdminLogin.php");
 }


 function Matches_Played($conn,$tid){
 	$sql = "SELECT TEAM_ID from matches_played where TEAM_ID = $tid";
 	$result =  mysqli_query($conn,$sql);

 	if(mysqli_num_rows($result) == 1){
 		$query = "SELECT Matches_Played FROM matches_played where TEAM_ID = $tid";
 		$run = mysqli_query($conn,$query)->fetch_array();
 		return $run[0];
 	}else
 		return 0;


 }


 function Matches_Won($conn,$tid){
 	$sql = "SELECT TEAM_ID from matches_won where TEAM_ID = $tid";
 	$result =  mysqli_query($conn,$sql);

 	if(mysqli_num_rows($result) == 1){
 		$query = "SELECT MATCHES_WON FROM matches_won where TEAM_ID = $tid";
 		$run = mysqli_query($conn,$query)->fetch_array();
 		return $run[0];
 	}else
 		return 0;

 }

  function Matches_Lost($conn,$tid){
 	$sql = "SELECT TEAM_ID from matches_lost where TEAM_ID = $tid";
 	$result =  mysqli_query($conn,$sql);

 	if(mysqli_num_rows($result) == 1){
 		$query = "SELECT MATCHES_LOST FROM matches_lost where TEAM_ID = $tid";
 		$run = mysqli_query($conn,$query)->fetch_array();
 		return $run[0];
 	}else
 		return 0;

 }

   function Points($conn,$tid){
 	$sql = "SELECT TEAM_ID from points where TEAM_ID = $tid";
 	$result =  mysqli_query($conn,$sql);

 	if(mysqli_num_rows($result) == 1){
 		$query = "SELECT Points FROM points where TEAM_ID = $tid";
 		$run = mysqli_query($conn,$query)->fetch_array();
 		return $run[0];
 	}else
 		return 0;

 }


 


 ?>


</body>
</html>

