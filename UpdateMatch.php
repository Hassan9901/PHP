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

	<button><a href="?updatedate_" name="date">Update Date</a></button>
	<button><a href="?updatetime_" name="time">Update Time</a></button>
	<button><a href="?updatesid_" name="sid">Update Stadium Id</a></button>
	<button><a href="?updateeid_" name="eid">Update Event Id</a></button><br><br>




	<?php 

	if (isset($_GET['updatedate_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='mid'><br><br>
		<label>Date</label>
		<input type='date' name='date'><br><br>
		<input type='submit' name='Update_date'><br><br>
		</form>
		";
	}

	if (isset($_GET['updatetime_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='mid'><br><br>
		<label>Time</label>
		<input type='time' name='time'><br><br>
		<input type='submit' name='Update_time'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatesid_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='mid'><br><br>
		<label>Stadium Id</label>
		<input type='text' name='sid'><br><br>
		<input type='submit' name='Update_sid'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateeid_'])) {
		echo "
		<form method='_GET'>
		<label>Match Id</label>
		<input type='text' name='mid'><br><br>
		<label>Event id</label>
		<input type='text' name='eid'><br><br>
		<input type='submit' name='Update_eid'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_date'])) {

		$id = $_GET['mid'];
		$date = $_GET['date'];


		if(isvalidId($id)){
			if ($date > date("Y-m-d")) {


				$sql = "SELECT * FROM match_ WHERE MATCH_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "UPDATE match_ SET DATE = '$date' WHERE MATCH_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}
				}else
				echo "<script>alert('Match id ".$id." does not exist.')</script>";
			}else
			echo "<script>alert('Invalid date ☹️. Date can not be less than or equal to current date.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid match id.')</script>";

	}


	if (isset($_GET['Update_time'])) {
		
		$id = $_GET['mid'];
		$time = $_GET['time'];

		if(isvalidId($id)){		

			$sql = "SELECT * FROM match_ WHERE MATCH_ID = $id";

			$result = mysqli_query($conn,$sql);

			if (mysqli_num_rows($result) == 1) {
				$query = "UPDATE match_ SET TIME = '$time' WHERE MATCH_ID = $id";
				$run = mysqli_query($conn,$query);
				if ($run == true) {
					echo "Data Updated";
				}
			}else
			echo "<script>alert('MATCH id ".$id." does not exist.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}


	if (isset($_GET['Update_sid'])) {

		$id = $_GET['mid'];
		$sid = $_GET['sid'];

		if(isvalidId($id)){
			if (isvalidId($sid)) {

				$sql = "SELECT * FROM match_ WHERE MATCH_ID = $id";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE match_ SET STADIUM_ID = $sid WHERE MATCH_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}else
					echo "<script>alert('Stadium id ".$sid." does not exist in table Stadium.')</script>";	
				}else
				echo "<script>alert('Match id ".$id." does not exist.')</script>";
			}else
			echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid Match id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}


	if (isset($_GET['Update_eid'])) {

		$id = $_GET['mid'];
		$eid = $_GET['eid'];

		if(isvalidId($id)){
			if (isvalidId($eid)) {

				$sql = "SELECT * FROM match_ WHERE MATCH_ID = $id";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE match_ SET EVENT_ID = $eid WHERE MATCH_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}else
					echo "<script>alert('Event id ".$eid." does not exist in table Event.')</script>";	
				}else
				echo "<script>alert('Match id ".$id." does not exist.')</script>";
			}else
			echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
		}else
		echo "<script>alert('Invalid Match id ☹️. Please Enter valid Match id.')</script>";
	}

	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	?>


</body>
</html>