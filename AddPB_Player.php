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
		<input type="text" name="Mid"><br><br>
		<label>Player Id</label>
		<input type="text" name="Pid"><br><br>
		<label>Runs Scored</label>
		<input type="text" name="runs"><br><br>
		<label>Wickets Taken</label>
		<input type="text" name="wickets"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$mid = $_POST['Mid'];
		$pid = $_POST['Pid'];
		$runs = $_POST['runs'];
		$wickets = $_POST['wickets'];
		
		if(isvalidMId($mid)){
			if(isvalidLimit($conn,$mid)){
				if(isvalidPId($pid)){
					if(isvalidRuns($runs)){
						if (isvalidWickets($wickets)) {
							


							$sql = "INSERT INTO plays (MATCH_ID,PLAYER_ID,RUNS,WICKETS) VALUES ($mid,$pid,'$runs','$wickets')";
							$query = mysqli_query($conn,$sql);
							if($query == 1)
								echo "Data added.";
							else{
								$sql2 = "SELECT * FROM plays WHERE MATCH_ID = $mid AND PLAYER_ID =$pid";
								$result2 = mysqli_query($conn,$sql2);
								$result2 = mysqli_num_rows($result2);

								if($result2 == 1){
									echo "Match id ".$mid." and Player id ".$pid." already exist in table.";
								}else{
									$q2 = "SELECT MATCH_ID from match_ WHERE MATCH_ID = $mid";
									$r2 = mysqli_query($conn,$q2);
									if(mysqli_num_rows($r2) != 1){
										echo 'Match Id '.$mid.' does not exist in "match" table.';
									}

									$q2 = "SELECT PLAYER_ID from player WHERE PLAYER_ID = $pid";
									$r2 = mysqli_query($conn,$q2);
									if(mysqli_num_rows($r2) != 1){
										echo '<br>Player Id '.$pid.' does not exist in "player" table.';
									}
								}
							}
						}else
						echo "<script>alert('Invalid  wickets entered☹️. Please Enter valid wickets')</script>";
					}else
					echo "<script>alert('Invalid runs ☹️. Please Enter valid runs')</script>";
				}else
				echo "<script>alert('Invalid Player id☹️. Please Enter valid Player id')</script>";
			}else
			echo "<script>alert('Match Limit reached ☹️. There can not be more than 22 players in a match.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	function isvalidMId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
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

	function isvalidPId($id){
		$id = (int) $id;
		if($id > 0 && $id < 10000)
			return true;
	}



	function isvalidLimit($conn,$mid){
		$sql = "SELECT * from plays WHERE MATCH_ID = $mid";
		$run = mysqli_query($conn,$sql);
		if(mysqli_num_rows($run) < 22)
			return true;
		else
			return false;

	}

	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
	}

	?>



</body>
</html>
