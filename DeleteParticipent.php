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
		<label>Team ID</label>
		<input type="text" name="Teamid"><br><br>
		<label>Event ID</label>
		<input type="text" name="Eventid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$Tid = $_GET['Teamid'];
		$Eid = $_GET['Eventid'];

		if (isvalidTid($Tid)) {
			if (isvalidEid($Eid)) {
				
				$sql = "SELECT * FROM participate WHERE TEAM_ID = $Tid && EVENT_ID = $Eid";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "DELETE FROM participate WHERE TEAM_ID = $Tid && EVENT_ID = $Eid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Deleted";
					}
				}else{
					$query = "SELECT * FROM participate WHERE TEAM_ID = $Tid";
					$execute = mysqli_query($conn,$query);
					if (mysqli_num_rows($execute) > 0) {
						echo "<script>alert('Event id ".$Eid." does not exist in table participate.')</script>";
					}else
					echo "<script>alert('Team id ".$Tid." does not exist in table participate.')</script>";	
				}
				
			}else
			echo "<script>alert('Invalid Event id☹️. Please Enter valid event id')</script>";
		}else
		echo "<script>alert('Invalid Admin id☹️. Please Enter valid Adminid id')</script>";

	}

	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
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