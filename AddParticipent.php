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
		<label>Team Id</label>
		<input type="text" name="TeamId"><br><br>
		<label>Event Id</label>
		<input type="text" name="EventId"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$Tid = $_POST['TeamId'];
		$Eid = $_POST['EventId'];
		

		if(isvalidTid($Tid)){
			if(isValidEid($Eid)){
		
				$sql = "INSERT INTO participate (TEAM_ID,EVENT_ID) VALUES ($Tid,$Eid)";
				$query = mysqli_query($conn,$sql);
				if($query == 1)
					echo "Data added.";
				else{
					$sql2 = "SELECT * FROM participate WHERE TEAM_ID = $Tid AND EVENT_ID =$Eid";
					$result2 = mysqli_query($conn,$sql2);
					$result2 = mysqli_num_rows($result2);

					if($result2 == 1){
						echo "Team id ".$Tid." and event id ".$Eid." already exist in table.";
					}else{
						$q2 = "SELECT TEAM_ID from team WHERE TEAM_ID = $Tid";
						$r2 = mysqli_query($conn,$q2);
						if(mysqli_num_rows($r2) != 1){
							echo 'Team Id '.$Tid.' does not exist in "team" table.';
						}

						$q2 = "SELECT EVENT_ID from event_ WHERE EVENT_ID = $Eid";
						$r2 = mysqli_query($conn,$q2);
						if(mysqli_num_rows($r2) != 1){
							echo '<br>Event Id '.$Eid.' does not exist in "event_" table.';
						}
					}
				}

			}else
			echo "<script>alert('Invalid Event id☹️. Please Enter valid event id')</script>";
		}else
		echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
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
	
	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
	}

	?>



</body>
</html>
