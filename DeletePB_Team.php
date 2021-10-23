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
	
	<form method="_POST">
		<label>Match ID</label>
		<input type="text" name="Mid"><br><br>
		<label>Team ID</label>
		<input type="text" name="Tid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$Mid = $_GET['Mid'];
		$Tid = $_GET['Tid'];

		if (isvalidMId($Mid)) {
			if (isvalidTId($Tid)) {
				
				$sql = "SELECT * FROM played_by WHERE MATCH_ID = $Mid && TEAM_ID = $Tid";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "DELETE FROM played_by WHERE MATCH_ID = $Mid && TEAM_ID = $Tid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Deleted";
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
						echo "<script>alert('Match id ".$Mid."  and Team id ".$Tid." does not exist in table played_by.')</script>";	
					}
				}
			}else
			echo "<script>alert('Invalid Team id☹️. Please Enter valid Team id')</script>";
		}else
		echo "<script>alert('Invalid Match id☹️. Please Enter valid Match id')</script>";
	}

	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
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




	?>


</body>
</html>