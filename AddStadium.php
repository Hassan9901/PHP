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
		<label>Stadium Id</label>
		<input type="text" name="SId"><br><br>
		<label>Stadium Name</label>
		<input type="text" name="SN"><br><br>
		<label>Crowd Capacity</label>
		<input type="text" name="CC"><br><br>
		<label>City Id</label>
		<input type="text" name="CId"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$SId = $_POST['SId'];
		$SN = $_POST['SN'];
		$CC = $_POST['CC'];
		$CId = $_POST['CId'];

		if(isvalidStadiumId($SId)){
			if(isValidName($SN)){
				if (isvalidCP($CC)) {
					if (isvalidCityId($CId)) {
						
						AddStadium($conn,$SId,$SN,$CC,$CId);

					}else
					echo "<script>alert('Invalid city id ☹️. Please Enter valid city id')</script>";
				}else
				echo "<script>alert('Invalid crowd capacity ☹️. Please Enter valid crowd capacity')</script>";
			}else
			echo "<script>alert('Invalid Stadium name ☹️. Please Enter valid city name.')</script>";
		}else
		echo "<script>alert('Invalid Stadium id ☹️. Please Enter valid city id')</script>";
	}


	function AddStadium($conn,$SId,$SN,$CC,$CId){
		$q1 = "SELECT * from city WHERE CITY_ID = $CId";
		$r1 = mysqli_query($conn,$q1);
		if(mysqli_num_rows($r1) > 0){

		$sql = "INSERT INTO stadium (STADIUM_ID,STADIUM_NAME,CROWD_CAPACITY,CITY_ID) VALUES ($SId,'$SN',$CC,$CId)";
		$run = mysqli_query($conn,$sql);
		echo "".$run;

		if($run == 1)
			echo "Data added.";
		else{
			$sql2 = "SELECT * FROM stadium WHERE STADIUM_ID = $SId";
			$result2 = mysqli_query($conn,$sql2);
			if (mysqli_num_rows($result2) > 0) {
				echo "Stadium ID ".$SId." already exist in table.";
			}
			$sql3 = "SELECT * FROM Stadium WHERE STADIUM_NAME = '$SN'";
			$result3 = mysqli_query($conn,$sql3);
			if (mysqli_num_rows($result3) > 0) 
				echo "Stadium name ".$SN." already exist in table.";

			// $sql3 = "SELECT * FROM City WHERE CITY_ID = $CId";
			// $result3 = mysqli_query($conn,$sql3);
			// if (!(mysqli_num_rows($result3) > 0)) 
			// 	echo "City id ".$CId." does not exist in city table.";
		}
		
		}else
		echo "<script>alert('City id ".$CId." does not exist in city table.')</script>";
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
