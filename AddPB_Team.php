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
		<input type="text" name="Tid"><br><br>
		<label>Match Id</label>
		<input type="text" name="Mid"><br><br>
		<label>Wickets</label>
		<input type="text" name="Wickets"><br><br>
		<label>Score</label>
		<input type="text" name="Score"><br><br>
		<label>Result</label>
		<input type="text" name="Result"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$tid = $_POST['Tid'];
		$mid = $_POST['Mid'];
		$wickets = $_POST['Wickets'];
		$score = $_POST['Score'];
		$result = $_POST['Result'];
		
		if(isvalidMId($mid)){
			if(isvalidLimit($conn,$mid)){
				if(isvalidTId($tid)){
					if(isvalidWickets($wickets)){
						if (isvalidScore($score)) {
							
							$sql = "INSERT INTO played_by (TEAM_ID,MATCH_ID,WICKETS,SCORE,RESULT) VALUES ($tid,$mid,$wickets,$score,'$result')";
							$query = mysqli_query($conn,$sql);
							if($query == 1)
								echo "Data added.";
							else{
								$sql2 = "SELECT * FROM played_by WHERE MATCH_ID = $mid AND TEAM_ID = $tid";
								$result2 = mysqli_query($conn,$sql2);
								$result2 = mysqli_num_rows($result2);

								if($result2 == 1){
									echo "Match id ".$mid." and Team id ".$tid." already exist in table.";
								}else{
									$q2 = "SELECT MATCH_ID from match_ WHERE MATCH_ID = $mid";
									$r2 = mysqli_query($conn,$q2);
									if(mysqli_num_rows($r2) != 1){
										echo 'Match Id '.$mid.' does not exist in "match" table.';
									}

									$q2 = "SELECT TEAM_ID from team WHERE TEAM_ID = $tid";
									$r2 = mysqli_query($conn,$q2);
									if(mysqli_num_rows($r2) != 1){
										echo '<br>Team Id '.$tid.' does not exist in "team" table.';
									}
								}
							}
						}else
						echo "<script>alert('Invalid  Score entered☹️. Please Enter valid Score')</script>";
					}else
					echo "<script>alert('Invalid Wickets ☹️. Please Enter valid Wickets')</script>";
				}else
				echo "<script>alert('Invalid Team id☹️. Please Enter valid Team id')</script>";
			}else
			echo "<script>alert('Match Limit reached ☹️. There can not be more than 2 teams in a match.')</script>";
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

	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
	}

	?>



</body>
</html>
