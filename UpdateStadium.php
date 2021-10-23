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

	<button><a href="?updatename_" name="updatename">Update Stadium Name</a></button>
	<button><a href="?updatecc_" name="updatecc">Update crowd capacity</a></button>
	<button><a href="?updatecityid_" name="updatecid">Update City id</a></button>	

	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>Stadium Id</label>
		<input type='text' name='Sid'><br><br>
		<label>Stadium Name</label>
		<input type='text' name='name'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	if (isset($_GET['updatecc_'])) {
		echo "
		<form method='_GET'>
		<label>Stadium Id</label>
		<input type='text' name='Sid'><br><br>
		<label>Crowd Capacity</label>
		<input type='text' name='cc'><br><br>
		<input type='submit' name='Update_cc'><br><br>
		</form>
		";
	}
	
	if (isset($_GET['updatecityid_'])) {
		echo "
		<form method='_GET'>
		<label>Stadium Id</label>
		<input type='text' name='Sid'><br><br>
		<label>City id</label>
		<input type='text' name='cityid'><br><br>
		<input type='submit' name='Update_cityid'><br><br>
		</form>
		";
	}

	if (isset($_GET['Update_name'])) {
		$id = $_GET['Sid'];
		$name = $_GET['name'];

		if(isvalidStadiumId($id)){
			if (isValidName($name)) {

				$sql = "SELECT * FROM Stadium WHERE STADIUM_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$result = mysqli_fetch_assoc($result);
					$result = $result['STADIUM_NAME'];

					if(strcasecmp($name,$result) != 0){
						$query = "UPDATE Stadium SET STADIUM_NAME = '$name' WHERE STADIUM_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else
					echo "<script>alert('Stadium name ".$name." already exist.')</script>";
				}else
				echo "<script>alert('Stadium id ".$id." does not exist in stadium table.')</script>";
			}else
			echo "<script>alert('Invalid Stadium name☹️. Please Enter valid Stadium name')</script>";
		}else
		echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid Stadium id.')</script>";

	}


	if (isset($_GET['Update_cc'])) {
		$id = $_GET['Sid'];
		$cc = $_GET['cc'];

		if(isvalidStadiumId($id)){
			if (isvalidCP($cc)) {

				$sql = "SELECT * FROM Stadium WHERE STADIUM_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE Stadium SET CROWD_CAPACITY = $cc WHERE STADIUM_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}else
					echo "<script>alert('Stadium id ".$id." does not exist in stadium table.')</script>";	
				}else
				echo "<script>alert('Stadium id ".$id." does not exist in stadium table.')</script>";
			}else
			echo "<script>alert('Invalid Crowd Capacity☹️. Please Enter valid Crowd Capacity')</script>";
		}else
		echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid Stadium id.')</script>";

	}



	if (isset($_GET['Update_cityid'])) {

		$sid = $_GET['Sid'];
		$cid = $_GET['cityid'];

		if(isvalidStadiumId($sid)){
			if (isvalidCityId($cid)) {

				$sql = "SELECT * FROM Stadium WHERE STADIUM_ID = $sid";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE stadium SET CITY_ID = $cid WHERE STADIUM_ID = $sid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br><br>Data Updated";
					}else
					echo "<script>alert('City id ".$cid." does not exist in table city.')</script>";	
				}else
				echo "<script>alert('Stadium id ".$sid." does not exist in table.')</script>";
			}else
			echo "<script>alert('Invalid City id ☹️. Please Enter valid City id.')</script>";
		}else
		echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid Stadium id.')</script>";
	}

	function isvalidStadiumId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	function isvalidCP($cp){
		$id = (int) $cp;
		if($cp > 0 && $cp < 10000000000)
			return true;
	}

	function isvalidCityId($cid){
		$id = (int) $cid;
		if(($cid > 0 && $cid < 100000))
			return true;
	}

	function isValidName($name){
		$bool = true;
		for ($i=0; $i < strlen($name); $i++) { 
			if(!isValidCharacter($name[$i])){
				$bool = false;
				break;
			}
		}
		if ($bool == true) {
			return true;
		}else
		return false;

	}

	function isValidCharacter($char){
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z')
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