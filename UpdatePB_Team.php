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

	<button><a href="?updateTeamId_" name="TeamId">Update Team Id</a></button><br><br>
	<button><a href="?updateMatchId_" name="MatchId">Update Match Id</a></button><br><br>
	<button><a href="?updateWickets_" name="Wickets">Update Wickets</a></button><br><br>
	<button><a href="?updateScore_" name="Score">Update Score</a></button><br><br>
	<button><a href="?updateResult_" name="Result">Update Result</a></button><br><br>




	<?php 

	if (isset($_GET['updateTeamId_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='Mid'>";
		echo "   Enter Match id of which Team id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Team id</label>
		<input type='text' name='oldTid'><br><br>
		<label>New Team id</label>
		<input type='text' name='newTid'><br><br>
		<input type='submit' name='Update_TeamId'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateMatchId_'])) {
		echo "
		<form method='_GET'>
		<label>Team Id</label>
		<input type='text' name='Tid'>";
		echo "   Enter Team id of which Match id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Match id</label>
		<input type='text' name='oldMid'><br><br>
		<label>New Match id</label>
		<input type='text' name='newMid'><br><br>
		<input type='submit' name='Update_MatchId'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateWickets_'])) {
		echo "
		<form method='_GET'>
		<label>Team id</label>
		<input type='text' name='Tid'><br><br>
		<label>Match Id</label>
		<input type='text' name='Mid'><br><br>
		<label>Wickets</label>
		<input type='text' name='Wickets'><br><br>
		<input type='submit' name='Update_Wickets'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateScore_'])) {
		echo "
		<form method='_GET'>
		<label>Team id</label>
		<input type='text' name='Tid'><br><br>
		<label>Match Id</label>
		<input type='text' name='Mid'><br><br>
		<label>Score</label>
		<input type='text' name='Score'><br><br>
		<input type='submit' name='Update_Score'><br><br>
		</form>
		";
	}

	if (isset($_GET['updateResult_'])) {
		echo "
		<form method='_GET'>
		<label>Team id</label>
		<input type='text' name='Tid'><br><br>
		<label>Match Id</label>
		<input type='text' name='Mid'><br><br>
		<label>Result</label>
		<input type='text' name='Result'><br><br>
		<input type='submit' name='Update_Result'><br><br>
		</form>
		";
	}

	if (isset($_GET['Update_MatchId'])) {

		$Tid = $_GET['Tid'];
		$OMid = $_GET['oldMid'];
		$NMid = $_GET['newMid'];

		if(isvalidTId($Tid)){
			if (isvalidMId($OMid)) {
				if (isvalidMId($NMid)) {

					$sql = "SELECT * FROM played_by WHERE TEAM_ID = $Tid && MATCH_ID = $OMid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE played_by SET MATCH_ID = $NMid WHERE TEAM_ID = $Tid AND MATCH_ID = $OMid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM played_by WHERE TEAM_ID = $Tid && MATCH_ID = $NMid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Match id ".$NMid." already exist in table played_by with Team id ".$Tid."')</script>";
							}else
							echo "<script>alert('Match id ".$NMid." does not exist in table Match.')</script>";	
						}
					}
					else{
						$sql2 = "SELECT * FROM played_by WHERE TEAM_ID = $Tid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Match id ".$OMid." does not exist in table played_by with Player id ".$Pid."')</script>";
						}else
						echo "<script>alert('Team id ".$Tid." does not exist in table played_by.')</script>";
					}
				}else
				echo "<script>alert('Invalid New Match id ☹️. Please Enter valid new Match id.')</script>";
			}else
			echo "<script>alert('Invalid Old Match id ☹️. Please Enter valid old Match id.')</script>";
		}else
		echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
	}



	if (isset($_GET['Update_TeamId'])) {

		$Mid = $_GET['Mid'];
		$OTid = $_GET['oldTid'];
		$NTid = $_GET['newTid'];

		if(isvalidMId($Mid)){
			if (isvalidTId($OTid)) {
				if (isvalidTId($NTid)) {

					$sql = "SELECT * FROM played_by WHERE TEAM_ID = $OTid && MATCH_ID = $Mid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE played_by SET TEAM_ID = $NTid WHERE MATCH_ID = $Mid AND TEAM_ID = $OTid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM played_by WHERE MATCH_ID = $Mid && TEAM_ID = $NTid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Team id ".$NTid." already exist in table played_by with Match id ".$Mid."')</script>";
							}else
							echo "<script>alert('Team id ".$NTid." does not exist in table team.')</script>";	
						}
					}
					else{
						$sql2 = "SELECT * FROM played_by WHERE MATCH_ID = $Mid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Team id ".$OTid." does not exist in table plays with Match id ".$Mid."')</script>";
						}else
						echo "<script>alert('Match id ".$Mid." does not exist in table played_by.')</script>";
					}
				}else
				echo "<script>alert('Invalid New Team id ☹️. Please Enter valid new Team id.')</script>";
			}else
			echo "<script>alert('Invalid Old Team id ☹️. Please Enter valid old Team id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}



	if (isset($_GET['Update_Score'])) {

		$Mid = $_GET['Mid'];
		$Tid = $_GET['Tid'];
		$Score = $_GET['Score'];

		if(isvalidMId($Mid)){
			if (isvalidTId($Tid)) {
				if (isvalidScore($Score)) {

					$sql = "SELECT * FROM played_by WHERE TEAM_ID = $Tid && MATCH_ID = $Mid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE played_by SET SCORE = $Score WHERE MATCH_ID = $Mid AND TEAM_ID = $Tid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else{
						$query = "SELECT * FROM played_by WHERE MATCH_ID = $Mid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Team id ".$Tid." does not exist in table plays with Match id ".$Mid."')</script>";
						}else{
							$query = "SELECT * FROM played_by WHERE TEAM_ID = $Tid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Match id ".$Mid." does not exist in table played_by with Team id ".$Tid."')</script>";
							}else
							echo "<script>alert('Match id ".$Mid."  and Team id ".$Pid." does not exist in table played_by.')</script>";
						}

					}
				}else
				echo "<script>alert('Invalid Score ☹️. Please Enter valid Score.')</script>";
			}else
			echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	if (isset($_GET['Update_Wickets'])) {

		$Mid = $_GET['Mid'];
		$Tid = $_GET['Tid'];
		$wickets = $_GET['Wickets'];

		if(isvalidMId($Mid)){
			if (isvalidTId($Tid)) {
				if (isvalidWickets($wickets)) {

					$sql = "SELECT * FROM played_by WHERE TEAM_ID = $Tid && MATCH_ID = $Mid";
					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE played_by SET WICKETS = $wickets WHERE MATCH_ID = $Mid AND TEAM_ID = $Tid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else{
						$query = "SELECT * FROM played_by WHERE MATCH_ID = $Mid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Team id ".$Tid." does not exist in table played_by with Match id ".$Mid."')</script>";
						}else{
							$query = "SELECT * FROM played_by WHERE TEAM_ID = $Tid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Match id ".$Mid." does not exist in table played_by with Team id ".$Tid."')</script>";
							}else
							echo "<script>alert('Match id ".$Mid."  and Team id ".$Tid." does not exist in table plays.')</script>";
						}
					}
				}else
				echo "<script>alert('Invalid  Wickets ☹️. Please Enter valid wickets.')</script>";
			}else
			echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	if (isset($_GET['Update_Result'])) {

		$Mid = $_GET['Mid'];
		$Tid = $_GET['Tid'];
		$Result = $_GET['Result'];

		if(isvalidMId($Mid)){
			if (isvalidTId($Tid)) {

				$sql = "SELECT * FROM played_by WHERE TEAM_ID = $Tid && MATCH_ID = $Mid";
				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) >= 1) {
					$query = "UPDATE played_by SET RESULT = '$Result' WHERE MATCH_ID = $Mid AND TEAM_ID = $Tid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}
				}else{
					$query = "SELECT * FROM played_by WHERE MATCH_ID = $Mid";
					$execute = mysqli_query($conn,$query);
					if (mysqli_num_rows($execute) > 0) {
						echo "<script>alert('Team id ".$Tid." does not exist in table played_by with Match id ".$Mid."')</script>";
					}else{
						$query = "SELECT * FROM played_by WHERE TEAM_ID = $Tid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Match id ".$Mid." does not exist in table played_by with Team id ".$Tid."')</script>";
						}else
						echo "<script>alert('Match id ".$Mid."  and Team id ".$Tid." does not exist in table plays.')</script>";
					}
				}
			}else
			echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	function isvalidTId($id){
		$id = (int) $id;
		if($id > 0 && $id < 1000)
			return true;
	}


	function isvalidMId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	function isvalidScore($runs){
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
		$sql = "SELECT * from played_by WHERE MATCH_ID = $mid";
		$run = mysqli_query($conn,$sql);
		if(mysqli_num_rows($run) < 2)
			return true;
		else
			return false;

	}

	?>


</body>
</html>