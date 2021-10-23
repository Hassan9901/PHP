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

	<button><a href="?updatename_" name="updatename">Update Name</a></button>
	<button><a href="?updateCountryId_" name="updatecid">Update Country id</a></button>
	

	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>City Id</label>
		<input type='text' name='Cityid'><br><br>
		<label>City Name</label>
		<input type='text' name='name'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	if (isset($_GET['updateCountryId_'])) {
		echo "
		<form method='_GET'>
		<label>City Id</label>
		<input type='text' name='Cityid'><br><br>
		<label>Country id</label>
		<input type='text' name='Countryid'><br><br>
		<input type='submit' name='Update_Countryid'><br><br>
		</form>
		";
	}
	
	if (isset($_GET['Update_name'])) {
			#echo "string";
		$id = $_GET['Cityid'];
		$name = $_GET['name'];
			#echo "$name<br>";

		if(isvalidCityId($id)){
			if (isValid($name)) {


				$sql = "SELECT * FROM city WHERE CITY_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$result = mysqli_fetch_assoc($result);
					$result = $result['CITY_NAME'];

					if(strcasecmp($name,$result) != 0){
						$query = "UPDATE city SET CITY_NAME = '$name' WHERE CITY_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else
					echo "<script>alert('City name ".$name." already exist.')</script>";
				}else
				echo "<script>alert('City id ".$id." does not exist in City table.')</script>";
			}else
			echo "<script>alert('Invalid City name☹️. Please Enter valid City name')</script>";
		}else
		echo "<script>alert('Invalid City id ☹️. Please Enter valid City id.')</script>";

	}


	if (isset($_GET['Update_Countryid'])) {
		
		$Cityid = $_GET['Cityid'];
		$Countryid = $_GET['Countryid'];

		if(isvalidCityId($Cityid)){
			if (isvalidCountryId($Countryid)) {

				$sql = "SELECT * FROM city WHERE CITY_ID = $Cityid";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE city SET COUNTRY_ID = $Countryid WHERE CITY_ID = $Cityid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br><br>Data Updated";
					}else
					echo "<script>alert('Country id ".$Countryid." does not exist in table Country.')</script>";	
				}else
				echo "<script>alert('City id ".$Cityid." does not exist in table city.')</script>";
			}else
			echo "<script>alert('Invalid Country id ☹️. Please Enter valid Country id.')</script>";
		}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";
	}

	function isvalidCityId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	function isvalidCountryId($id){
		$id = (int) $id;
		if(($id > 0 && $id < 1000))
			return true;
			// || (empty($id)
	}

	function isValid($name){
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