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
		<label>City Id</label>
		<input type="text" name="CityId"><br><br>
		<label>City Name</label>
		<input type="text" name="CityName"><br><br>
		<label>Country Id</label>
		<input type="text" name="CountryId"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$id = $_POST['CityId'];
		$name = $_POST['CityName'];
		$cid = $_POST['CountryId'];

		if(isvalidCityId($id)){
			if(isValid($name)){
				if (isvalidCountryId($cid)) {

				// // echo "".$id." ".$name;
				// 	$q1 = "SELECT * from Country WHERE country_id = $cid";
				// 	$r1 = mysqli_query($conn,$q1);
				// 	if(mysqli_num_rows($r1) > 0){

				// 		$sql = "INSERT INTO city (CITY_ID,CITY_NAME,COUNTRY_ID) VALUES ($id,'$name',$cid)";
				// 		$query = mysqli_query($conn,$sql);
				// 		if($query == 1)
				// 			echo "Data added.";
				// 		else{
				// 			$sql2 = "SELECT * FROM city WHERE CITY_ID = $id";
				// 			$result2 = mysqli_query($conn,$sql2);
				// 			if (mysqli_num_rows($result2) > 0) {
				// 				echo "City ID ".$id." already exist in table.";
				// 			}

				// 			$sql3 = "SELECT * FROM City WHERE CITY_NAME = '$name'";
				// 			$result3 = mysqli_query($conn,$sql3);
				// 			if (mysqli_num_rows($result3) > 0) 
				// 				echo "City name ".$name." already exist in table.";
				// 		}
				// 	}else
				// 	echo "<script>alert('Country id ".$cid." does not exist in country table.')</script>";

				// if (empty($cid)) {
				// 	AddWoutCid($conn,$id,$name);
				// }else
					AddWCid($conn,$id,$name,$cid);




				}else
				echo "<script>alert('Invalid country id ☹️. Please Enter valid country id')</script>";
			}else
			echo "<script>alert('Invalid City name ☹️. Please Enter valid city name.')</script>";
		}else
		echo "<script>alert('Invalid city id ☹️. Please Enter valid city id')</script>";
	}

/*
	function AddWoutCid($conn,$id,$name){
		$sql = "INSERT INTO city (CITY_ID,CITY_NAME) VALUES ($id,'$name')";
		$query = mysqli_query($conn,$sql);
		if($query == 1)
			echo "Data added.";
		else{
			$sql2 = "SELECT * FROM city WHERE CITY_ID = $id";
			$result2 = mysqli_query($conn,$sql2);
			if (mysqli_num_rows($result2) > 0) {
				echo "City ID ".$id." already exist in table.";
			}

			$sql3 = "SELECT * FROM City WHERE CITY_NAME = '$name'";
			$result3 = mysqli_query($conn,$sql3);
			if (mysqli_num_rows($result3) > 0) 
				echo "City name ".$name." already exist in table.";
		}
	}
*/


	function AddWCid($conn,$id,$name,$cid){
		$q1 = "SELECT * from Country WHERE country_id = $cid";
		$r1 = mysqli_query($conn,$q1);
		if(mysqli_num_rows($r1) > 0){

			$sql = "INSERT INTO city (CITY_ID,CITY_NAME,COUNTRY_ID) VALUES ($id,'$name',$cid)";
			$query = mysqli_query($conn,$sql);
			if($query == 1)
				echo "Data added.";
			else{
				$sql2 = "SELECT * FROM city WHERE CITY_ID = $id";
				$result2 = mysqli_query($conn,$sql2);
				if (mysqli_num_rows($result2) > 0) {
					echo "City ID ".$id." already exist in table.";
				}

				$sql3 = "SELECT * FROM City WHERE CITY_NAME = '$name'";
				$result3 = mysqli_query($conn,$sql3);
				if (mysqli_num_rows($result3) > 0) 
					echo "City name ".$name." already exist in table.";
			}
		}else
		echo "<script>alert('Country id ".$cid." does not exist in country table.')</script>";
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
