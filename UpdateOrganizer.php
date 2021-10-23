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

	<button><a href="?updateAdminid_" name="Adminid">Update Admin Id</a></button><br><br>
	<button><a href="?updateEventid_" name="Eventid">Update Event Id</a></button><br><br>




	<?php 

	if (isset($_GET['updateEventid_'])) {
		echo "
		<form method='_GET'>
		<label>Admin Id</label>
		<input type='text' name='Adminid'>";
		echo "   Enter Admin id of whose event id you want to change.";
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

	if (isset($_GET['updateAdminid_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'>";
		echo "   Enter Event id of whose Admin id you want to change.";
		echo "<br><br>";
		echo "
		<label>Old Admin id</label>
		<input type='text' name='oldAdminid'><br><br>
		<label>New Admin id</label>
		<input type='text' name='newAdminid'><br><br>
		<input type='submit' name='Update_Aid'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_Eid'])) {

		$Aid = $_GET['Adminid'];
		$OEid = $_GET['oldEventid'];
		$NEid = $_GET['newEventid'];

		if(isvalidAid($Aid)){
			if (isvalidEid($OEid)) {
				if (isvalidEid($NEid)) {


					$sql = "SELECT * FROM organizes WHERE ADMIN_ID = $Aid && EVENT_ID = $OEid";

					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE organizes SET EVENT_ID = $NEid WHERE ADMIN_ID = $Aid && EVENT_ID = $OEid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM organizes WHERE ADMIN_ID = $Aid && EVENT_ID = $NEid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Event id ".$NEid." already exist in table organizes with Admin id ".$Aid."')</script>";
							}else
							echo "<script>alert('Event id ".$NEid." does not exist in table Event.')</script>";	
						}
					}
					else{
						$sql2 = "SELECT * FROM organizes WHERE ADMIN_ID = $Aid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Event id ".$OEid." does not exist in table organizes with Admin id ".$Aid."')</script>";		
						}else
						echo "<script>alert('Admin id ".$Aid." does not exist in table organizes.')</script>";
					}
				}else
				echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
			}else
			echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
		}else
		echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
	}



	if (isset($_GET['Update_Aid'])) {

		$Eid = $_GET['Eventid'];
		$OAid = $_GET['oldAdminid'];
		$NAid = $_GET['newAdminid'];

		if(isvalidEid($Eid)){
			if (isvalidAid($OAid)) {
				if (isvalidAid($NAid)) {


					$sql = "SELECT * FROM organizes WHERE ADMIN_ID = $OAid && EVENT_ID = $Eid";

					$result = mysqli_query($conn,$sql);

					if (mysqli_num_rows($result) >= 1) {
						$query = "UPDATE organizes SET ADMIN_ID = $NAid WHERE EVENT_ID = $Eid && ADMIN_ID = $OAid";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else{
							$query = "SELECT * FROM organizes WHERE ADMIN_ID = $NAid && EVENT_ID = $Eid";
							$execute = mysqli_query($conn,$query);
							if (mysqli_num_rows($execute) > 0) {
								echo "<script>alert('Admin id ".$NAid." already exist in table organizes with Event id ".$Eid."')</script>";
							}else
							echo "<script>alert('Admin id ".$NAid." does not exist in table Admin.')</script>";	
						}
					}else{
						$sql2 = "SELECT * FROM organizes WHERE EVENT_ID = $Eid";
						$result2 = mysqli_query($conn,$sql2);	
						if (mysqli_num_rows($result2) >= 1) {					
							echo "<script>alert('Admin id ".$OAid." does not exist in table organizes with Event id ".$Eid."')</script>";		
						}else
						echo "<script>alert('Event id ".$Eid." does not exist in table organizes.')</script>";
					}
				}else
				echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
			}else
			echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
		}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
	}


	function isvalidAid($id){
		$id = (int) $id;
		if($id > 0 && $id < 100)
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