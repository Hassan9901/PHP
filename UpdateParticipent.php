<?php 

include('connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])	?>">
		<button name="logout">Log Out</button>
	</form>

	<button><a href="?updateTeamid_" name="Teamid">Update Team Id</a></button><br><br>
	<button><a href="?updateEventid_" name="Eventid">Update Event Id</a></button><br><br>




	<?php 

	if (isset($_GET['updateEventid_'])) {
		echo "
		<form method='_GET'>
		<label>Team Id</label>
		<input type='text' name='Teamid'>";
		echo "   Enter Team id of whose event id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Event id</label>
		<input type='text' name='oldEventid'><br><br>
		<label>New Event id</label>
		<input type='text' name='newEventid'><br><br>
		<input type='submit' name='Update_Eid'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateTeamid_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'>";
		echo "   Enter Event id of whose Team id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Team id</label>
		<input type='text' name='oldTeamid'><br><br>
		<label>New Team id</label>
		<input type='text' name='newTeamid'><br><br>
		<input type='submit' name='Update_Tid'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_Eid'])) {

		$Tid = $_GET['Teamid'];
		$OEid = $_GET['oldEventid'];
		$NEid = $_GET['newEventid'];

		if(isvalidTid($Tid)){
			if (isvalidEid($OEid)) {
				if (isvalidEid($NEid)) {


					$sql = "SELECT * FROM participate WHERE TEAM_ID = $Tid && EVENT_ID = $OEid";

					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE participate SET EVENT_ID = $NEid WHERE TEAM_ID = $Tid && EVENT_ID = $OEid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM participate WHERE TEAM_ID = $Tid && EVENT_ID = $NEid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Event id ".$NEid." already exist in table participate with Team id ".$Tid."')</script>";
							}else
							echo "<script>alert('Event id ".$NEid." does not exist in table Event.')</script>";	
						}
					}
					else{
						$sql2 = "SELECT * FROM participate WHERE TEAM_ID = $Tid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Event id ".$OEid." does not exist in table participate with Team id ".$Tid."')</script>";		
						}else
						echo "<script>alert('Team id ".$Tid." does not exist in table participate.')</script>";
					}
				}else
				echo "<script>alert('Invalid New Event id ☹️. Please Enter valid new Event id.')</script>";
			}else
			echo "<script>alert('Invalid Old Event id ☹️. Please Enter valid old Event id.')</script>";
		}else
		echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
	}



	if (isset($_GET['Update_Tid'])) {

		$Eid = $_GET['Eventid'];
		$OTid = $_GET['oldTeamid'];
		$NTid = $_GET['newTeamid'];

		if(isvalidEid($Eid)){
			if (isvalidTid($OTid)) {
				if (isvalidTid($NTid)) {


					$sql = "SELECT * FROM participate WHERE TEAM_ID = $OTid && EVENT_ID = $Eid";

					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE participate SET TEAM_ID = $NTid WHERE EVENT_ID = $Eid && TEAM_ID = $OTid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM participate WHERE TEAM_ID = $NTid && EVENT_ID = $Eid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Team id ".$NTid." already exist in table participate with Event id ".$Eid."')</script>";
							}else
							echo "<script>alert('Team id ".$NTid." does not exist in table team.')</script>";	
						}
					}else{
						$sql2 = "SELECT * FROM participate WHERE EVENT_ID = $Eid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Team id ".$OTid." does not exist in table participate with Event id ".$Eid."')</script>";
						}else
						echo "<script>alert('Event id ".$Eid." does not exist in table participate with.')</script>";
					}
				}else
				echo "<script>alert('Invalid New Team id ☹️. Please Enter valid team id.')</script>";
			}else
			echo "<script>alert('Invalid Old Team id ☹️. Please Enter valid Team id.')</script>";
		}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
	}


	function isvalidTid($id){
		$id = (int) $id;
		if($id > 0 && $id < 1000)
			return true;
	}

	function isvalidEid($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	
	?>


</body>
</html>