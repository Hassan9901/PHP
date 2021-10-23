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

	<button class="bt"><a href="?updateMatchid_" name="Teamid">Update Match Id</a></button><br><br>
	<button><a href="?updatePlayerid_" name="Eventid">Update Player Id</a></button><br><br>
	<button><a href="?updateRuns_" name="Eventid">Update Runs</a></button><br><br>
	<button><a href="?updateWickets_" name="Eventid">Update Wickets</a></button><br><br>




	<?php 

	if (isset($_GET['updateMatchid_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='Pid'>";
		echo "   Enter Player id of whose Match id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Match id</label>
		<input type='text' name='oldMid'><br><br>
		<label>New Match id</label>
		<input type='text' name='newMid'><br><br>
		<input type='submit' name='Update_Mid'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatePlayerid_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='Mid'>";
		echo "   Enter Match id of which Player id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Player id</label>
		<input type='text' name='oldPid'><br><br>
		<label>New Player id</label>
		<input type='text' name='newPid'><br><br>
		<input type='submit' name='Update_Pid'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateRuns_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='Mid'><br><br>
		<label>Player id</label>
		<input type='text' name='Pid'><br><br>
		<label>Runs</label>
		<input type='text' name='Runs'><br><br>
		<input type='submit' name='Update_Runs'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateWickets_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='Mid'><br><br>
		<label>Player id</label>
		<input type='text' name='Pid'><br><br>
		<label>Wickets</label>
		<input type='text' name='Wickets'><br><br>
		<input type='submit' name='Update_Wickets'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_Mid'])) {

		$Pid = $_GET['Pid'];
		$OMid = $_GET['oldMid'];
		$NMid = $_GET['newMid'];

		if(isvalidPId($Pid)){
			if (isvalidMId($OMid)) {
				if(isvalidLimit($conn,$OMid)){
					if (isvalidMId($NMid)) {

						$sql = "SELECT * FROM plays WHERE PLAYER_ID = $Pid && MATCH_ID = $OMid";
						$result = mysqli_query($conn,$sql);

						if (mysqli_num_rows($result) >= 1) {
							$query = "UPDATE plays SET MATCH_ID = $NMid WHERE PLAYER_ID = $Pid AND MATCH_ID = $OMid";
							$run = mysqli_query($conn,$query);
							if ($run == true) {
								echo "Data Updated";
							}else{
								$query = "SELECT * FROM plays WHERE PLAYER_ID = $Pid && MATCH_ID = $NMid";
								$execute = mysqli_query($conn,$query);
								if (mysqli_num_rows($execute) > 0) {
									echo "<script>alert('Match id ".$NMid." already exist in table plays with Player id ".$Pid."')</script>";
								}else
								echo "<script>alert('Match id ".$NMid." does not exist in table Match.')</script>";	
							}
						}
						else{
							$sql2 = "SELECT * FROM plays WHERE PLAER_ID = $Pid";
							$result2 = mysqli_query($conn,$sql2);	
							if (mysqli_num_rows($result2) >= 1) {					
								echo "<script>alert('Match id ".$OMid." does not exist in table plays with Player id ".$Pid."')</script>";
							}else
							echo "<script>alert('Player id ".$Pid." does not exist in table plays.')</script>";
						}
					}else
					echo "<script>alert('Invalid New Match id ☹️. Please Enter valid new Match id.')</script>";
				}else
				echo "<script>alert('Match Limit reached ☹️. There can not be more than 22 players in a match.')</script>";
			}else
			echo "<script>alert('Invalid Old Match id ☹️. Please Enter valid old Match id.')</script>";
		}else
		echo "<script>alert('Invalid Player id ☹️. Please Enter valid Player id.')</script>";
	}



	if (isset($_GET['Update_Pid'])) {

		$Mid = $_GET['Mid'];
		$OPid = $_GET['oldPid'];
		$NPid = $_GET['newPid'];

		if(isvalidMId($Mid)){
			if(isvalidLimit($conn,$Mid)){
				if (isvalidPId($OPid)) {
					if (isvalidPId($NPid)) {

						$sql = "SELECT * FROM plays WHERE PLAYER_ID = $OPid && MATCH_ID = $Mid";
						$result = mysqli_query($conn,$sql);

						if (mysqli_num_rows($result) >= 1) {
							$query = "UPDATE plays SET PLAYER_ID = $NPid WHERE MATCH_ID = $Mid AND PLAYER_ID = $OPid";
							$run = mysqli_query($conn,$query);
							if ($run == true) {
								echo "Data Updated";
							}else{
								$query = "SELECT * FROM plays WHERE MATCH_ID = $Mid && PLAYER_ID = $NPid";
								$execute = mysqli_query($conn,$query);
								if (mysqli_num_rows($execute) > 0) {
									echo "<script>alert('Player id ".$NPid." already exist in table plays with Match id ".$Mid."')</script>";
								}else
								echo "<script>alert('Player id ".$NPid." does not exist in table Player.')</script>";	
							}
						}
						else{
							$sql2 = "SELECT * FROM plays WHERE MATCH_ID = $Mid";
							$result2 = mysqli_query($conn,$sql2);	
							if (mysqli_num_rows($result2) >= 1) {					
								echo "<script>alert('Player id ".$OPid." does not exist in table plays with Match id ".$Mid."')</script>";
							}else
							echo "<script>alert('Match id ".$Mid." does not exist in table plays.')</script>";
						}
					}else
					echo "<script>alert('Invalid New Player id ☹️. Please Enter valid new Player id.')</script>";
				}else
				echo "<script>alert('Invalid Old Player id ☹️. Please Enter valid old Player id.')</script>";
			}else
			echo "<script>alert('Match Limit reached ☹️. There can not be more than 22 players in a match.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}



	if (isset($_GET['Update_Runs'])) {

		$Mid = $_GET['Mid'];
		$Pid = $_GET['Pid'];
		$Runs = $_GET['Runs'];

		if(isvalidMId($Mid)){
			if (isvalidPId($Pid)) {
				if (isvalidRuns($Runs)) {

					$sql = "SELECT * FROM plays WHERE PLAYER_ID = $Pid && MATCH_ID = $Mid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE plays SET RUNS = $Runs WHERE MATCH_ID = $Mid AND PLAYER_ID = $Pid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else{
						$query = "SELECT * FROM plays WHERE MATCH_ID = $Mid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Player id ".$Pid." does not exist in table plays with Match id ".$Mid."')</script>";
						}else{
							$query = "SELECT * FROM plays WHERE PLAYER_ID = $Pid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Match id ".$Mid." does not exist in table plays with Player id ".$Pid."')</script>";
							}else
							echo "<script>alert('Match id ".$Mid."  and Player id ".$Pid." does not exist in table plays.')</script>";
						}

					}
				}else
				echo "<script>alert('Invalid  Runs ☹️. Please Enter valid Runs.')</script>";
			}else
			echo "<script>alert('Invalid Player id ☹️. Please Enter valid Player id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	if (isset($_GET['Update_Wickets'])) {

		$Mid = $_GET['Mid'];
		$Pid = $_GET['Pid'];
		$wickets = $_GET['Wickets'];

		if(isvalidMId($Mid)){
			if (isvalidPId($Pid)) {
				if (isvalidWickets($wickets)) {

					$sql = "SELECT * FROM plays WHERE PLAYER_ID = $Pid && MATCH_ID = $Mid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE plays SET WICKETS = $wickets WHERE MATCH_ID = $Mid AND PLAYER_ID = $Pid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else{
						$query = "SELECT * FROM plays WHERE MATCH_ID = $Mid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Player id ".$Pid." does not exist in table plays with Match id ".$Mid."')</script>";
						}else{
							$query = "SELECT * FROM plays WHERE PLAYER_ID = $Pid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Match id ".$Mid." does not exist in table plays with Player id ".$Pid."')</script>";
							}else
							echo "<script>alert('Match id ".$Mid."  and Player id ".$Pid." does not exist in table plays.')</script>";
						}

					}
				}else
				echo "<script>alert('Invalid  Wickets ☹️. Please Enter valid wickets.')</script>";
			}else
			echo "<script>alert('Invalid Player id ☹️. Please Enter valid Player id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	function isvalidMId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}


	function isvalidPId($id){
		$id = (int) $id;
		if($id > 0 && $id < 10000)
			return true;
	}

	function isvalidRuns($runs){
		$runs = (int) $runs;
		if($runs >= 0 && $runs <= 500){
			return true;
		}else
		return false;
	}

	function isvalidWickets($wickets){
		$wickets = (int) $wickets;
		if($wickets >= 0 && $wickets <= 10){
			return true;
		}else
		return false;
	}


	function isvalidLimit($conn,$mid){
		$sql = "SELECT * from plays WHERE MATCH_ID = $mid";
		$run = mysqli_query($conn,$sql);
		if(mysqli_num_rows($run) < 22)
			return true;
		else
			return false;

	}

	?>


</body>
</html>