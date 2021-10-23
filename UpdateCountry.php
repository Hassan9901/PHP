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
	

	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>Country Id</label>
		<input type='text' name='Countryid'><br><br>
		<label>Country Name</label>
		<input type='text' name='name'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	
	if (isset($_GET['Update_name'])) {
			#echo "string";
		$id = $_GET['Countryid'];
		$name = $_GET['name'];
			#echo "$name<br>";

		if(isvalidId($id)){
			if (isValid($name)) {


				$sql = "SELECT * FROM country WHERE COUNTRY_ID = $id ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$result = mysqli_fetch_assoc($result);
					$result = $result['COUNTRY_NAME'];

					if(strcasecmp($name,$result) != 0){
						$query = "UPDATE Country SET COUNTRY_NAME = '$name' WHERE COUNTRY_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}else
							echo("Country name ".$name." alrady exist");
					}else
					echo "<script>alert('Country name ".$name." already exist.')</script>";
				}else
					echo "<script>alert('Invalid Country id ☹️. Please Enter valid Country id.')</script>";
			}else
			echo "<script>alert('Invalid Country name☹️. Please Enter valid Country name')</script>";
		}else
		echo "<script>alert('Invalid Country id ☹️. Please Enter valid Country id.')</script>";

	}


	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 1000)
			return true;
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