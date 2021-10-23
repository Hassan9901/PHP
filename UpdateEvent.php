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

	<button><a href="?updatename_" name="name">Update Name</a></button>
	<button><a href="?updateyear_" name="year">Update Year</a></button>
	<button><a href="?updateformat_" name="updateformat">Update Format</a></button>
	<button><a href="?updatecountryid_" name="countryid">Update Country Id</a></button><br><br>




	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'><br><br>
		<label>Event Name</label>
		<input type='text' name='Eventname'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	if (isset($_GET['updateyear_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'><br><br>
		<label>Year</label>
		<input type='text' name='year'><br><br>
		<input type='submit' name='Update_year'><br><br>
		</form>
		";

	}

		if (isset($_GET['updateformat_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'><br><br>
		<label>Format</label>
		<input type='text' name='format'><br><br>
		<input type='submit' name='Update_format'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatecountryid_'])) {
		echo "
		<form method='_GET'>
		<label>Event Id</label>
		<input type='text' name='Eventid'><br><br>
		<label>Country id</label>
		<input type='text' name='cid'><br><br>
		<input type='submit' name='Update_cid'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_name'])) {

		$id = $_GET['Eventid'];
		$name = $_GET['Eventname'];
			

		if(isvalidId($id)){
			if (isValidName($name)) {


				$sql = "SELECT * FROM event_ WHERE EVENT_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
				// 	$result = mysqli_fetch_assoc($result);
				// 	$result = $result['USER_NAME'];

				// 	if(strcasecmp($name,$result) != 0){
						$query = "UPDATE event_ SET EVENT_NAME = '$name' WHERE EVENT_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else
						echo "<script>alert('Event id ".$id." does not exist in table event.')</script>";
					}else
					echo "<script>alert('Event id ".$id." does not exist in table event.')</script>";
			}else
			echo "<script>alert('Invalid Event name☹️. Please Enter valid Event name')</script>";
		}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Admin id.')</script>";

	}


	if (isset($_GET['Update_year'])) {
		
		$id = $_GET['Eventid'];
		$year = $_GET['year'];

		if(isvalidId($id)){
			if (isvalidYear($year)) {
				

		$sql = "SELECT * FROM event_ WHERE EVENT_ID = $id";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {
			$query = "UPDATE event_ SET YEAR = '$year' WHERE EVENT_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Updated";
			}
		}else
		echo "<script>alert('Event id ".$id." does not exist in table event.')</script>";
	}else
		echo "<script>alert('Invalid Year ☹️. Please Enter valid year.')</script>";
	}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
	}


	if (isset($_GET['Update_format'])) {
		
		$id = $_GET['Eventid'];
		$format = $_GET['format'];

		if(isvalidId($id)){
			if (isValidName($format)) {

		$sql = "SELECT * FROM event_ WHERE EVENT_ID = $id";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {
			$query = "UPDATE event_ SET FORMAT = '$format' WHERE EVENT_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Updated";
			}
		}else
		echo "<script>alert('Event id ".$id." does not exist in table event.')</script>";
	}else
		echo "<script>alert('Invalid format entered ☹️. Please Enter valid format.')</script>";
	}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
}


	if (isset($_GET['Update_cid'])) {
		
		$id = $_GET['Eventid'];
		$cid = $_GET['cid'];

		if(isvalidId($id)){
			if (isvalidCID($cid)) {
			
			

		$sql = "SELECT * FROM event_ WHERE EVENT_ID = $id";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {
			$query = "UPDATE event_ SET COUNTRY_ID = '$cid' WHERE EVENT_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Updated";
			}else
				echo "<script>alert('Country id ".$cid." does not exist in table Country.')</script>";	
		}else
		echo "<script>alert('Event id ".$id." does not exist in table event.')</script>";
	}else
		echo "<script>alert('Invalid Country id ☹️. Please Enter valid Country id.')</script>";
	}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
}
	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 10000)
			return true;
	}

	function isvalidYear($year){
		$id = (int) $year;
		if($year > 2015 && $year < 3000)
			return true;
	}

	function isvalidNofTeams($no){
		$id = (int) $no;
		if($no > 4 && $no < 20)
			return true;
	}

	function isvalidCID($id){
		$id = (int) $id;
		if($id > 0 && $id < 1000)
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
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z' || $char >= 0 || $char <= 9)
			return true;
		else
			return false;
	}

	?>


</body>
</html>