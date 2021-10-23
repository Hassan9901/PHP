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
		<label>Country Id</label>
		<input type="text" name="CountryId"><br><br>
		<label>Country Name</label>
		<input type="text" name="CountryName"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$id = $_POST['CountryId'];
		$name = $_POST['CountryName'];
		

		if(isvalidId($id)){
			if(isValid($name)){
		
				$sql = "INSERT INTO country (COUNTRY_ID,COUNTRY_NAME) VALUES ($id,'$name')";
				$query = mysqli_query($conn,$sql);
				echo "".$query;
				if($query == 1)
					echo "Data added.";
				else{
					$sql2 = "SELECT * FROM country WHERE COUNTRY_ID = '$id'";
					$result2 = mysqli_query($conn,$sql2);
					if (mysqli_num_rows($result2) > 0) {
						echo "Country ID ".$id." already exist in table.";
					}

					$sql3 = "SELECT * FROM Country WHERE COUNTRY_NAME = '$name'";
					$result3 = mysqli_query($conn,$sql3);
					if (mysqli_num_rows($result3) > 0) 
						echo "Country name ".$name." already exist in table.";
				}

			}else
			echo "<script>alert('Invalid country name☹️. Please Enter valid country name')</script>";
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
