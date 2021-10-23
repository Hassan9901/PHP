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

	<form method="POST">
		<label>Match Id</label>
		<input type="text" name="mid"><br><br>
		<label>Date</label>
		<input type="date" name="date"><br><br>
		<label>Time</label>
		<input type="time" name="time"><br><br>
		<label>Stadium Id</label>
		<input type="text" name="sid"><br><br>
		<label>Event id</label>
		<input type="text" name="eid"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$mid = $_POST['mid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$sid = $_POST['sid'];
		$eid = $_POST['eid'];


		// $q1 = "SELECT * from team WHERE team_id = $tid";
		// $r1 = mysqli_query($conn,$q1);

		if(isvalidId($mid)){
			if($date > date("Y-m-d")){
				if($time){
					if (isvalidId($sid)) {
						if(isvalidId($eid)){
							
							$sql = "INSERT INTO `match_` (`MATCH_ID`, `DATE`, `TIME`, `STADIUM_ID`, `EVENT_ID`) VALUES ($mid, '$date', '$time', $sid, $eid)";

							$result = mysqli_query($conn,$sql);

							if($result == 1)
								echo "Data added.";
							else{
								$sql2 = "SELECT * FROM `match_` WHERE MATCH_ID = $mid";
								$result2 = mysqli_query($conn,$sql2);
								if (mysqli_num_rows($result2) > 0) 
									echo "Match id ".$mid." already exist in table.";

								$sql3 = "SELECT * FROM `Stadium` WHERE STADIUM_ID = $sid";
								$result3 = mysqli_query($conn,$sql3);
								if (!mysqli_num_rows($result3) > 0) 
									echo "Stadium id ".$sid." does not exist in Stadim table.";

								$sql4 = "SELECT * FROM `Event_` WHERE EVENT_ID = $eid";
								$result4 = mysqli_query($conn,$sql4);
								if (!mysqli_num_rows($result4) > 0) 
									echo "Evenet id ".$eid." does not exist in Event table.";
							}

						}else
						echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
					}else
					echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid Stadium id.')</script>";
				}else
				echo "<script>alert('Invalid Time ☹️. Please Enter Time.')</script>";
			}else
			echo "<script>alert('Invalid Date ☹️. Date can not be less than or equal to current date.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}


	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	


	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
	}

	?>



</body>
</html>


