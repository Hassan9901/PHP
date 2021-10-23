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

	<button><a href="?updateFname_" name="name">Update First Name</a></button>
	<button><a href="?updateLname_" name="year">Update Last Name</a></button>
	<button><a href="?updateEmail_" name="updateEmail">Update Email</a></button>



	<?php 

	if (isset($_GET['updateFname_'])) {
		echo "
		<form method='_GET'>
		<label>Coach Id</label>
		<input type='text' name='Cid'><br><br>
		<label>First Name</label>
		<input type='text' name='Fname'><br><br>
		<input type='submit' name='Update_Fname'><br><br>
		</form>
		";
	}

	if (isset($_GET['updateLname_'])) {
		echo "
		<form method='_GET'>
		<label>Coach Id</label>
		<input type='text' name='Cid'><br><br>
		<label>Lats Name</label>
		<input type='text' name='Lname'><br><br>
		<input type='submit' name='Update_Lname'><br><br>
		</form>
		";

	}

	if (isset($_GET['updateEmail_'])) {
		echo "
		<form method='_GET'>
		<label>Coach Id</label>
		<input type='text' name='Cid'><br><br>
		<label>Email</label>
		<input type='text' name='Email'><br><br>
		<input type='submit' name='Update_Email'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_Fname'])) {

		$cid = $_GET['Cid'];
		$Fname = $_GET['Fname'];


		if(isvalidCoachId($cid)){
			if (isValidName($Fname)) {


				$sql = "SELECT * FROM coach WHERE COACH_ID = $cid ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "UPDATE coach SET FIRST_NAME = '$Fname' WHERE COACH_ID = $cid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br>Data Updated";
					}
				}else
				echo "<script>alert('Coach id ".$cid." does not exist in table.')</script>";
			}else
			echo "<script>alert('Invalid First name☹️. Please Enter valid First name')</script>";
		}else
		echo "<script>alert('Invalid Coach id ☹️. Please Enter valid Coach id.')</script>";

	}


	if (isset($_GET['Update_Lname'])) {

		$cid = $_GET['Cid'];
		$Lname = $_GET['Lname'];

		if(isvalidCoachId($cid)){
			if (isValidName($Lname)) {


				$sql = "SELECT * FROM coach WHERE COACH_ID = $cid ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "UPDATE coach SET LAST_NAME = '$Lname' WHERE COACH_ID = $cid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br>Data Updated";
					}
				}else
				echo "<script>alert('Coach id ".$cid." does not exist in table.')</script>";
			}else
			echo "<script>alert('Invalid Last name☹️. Please Enter valid Last name')</script>";
		}else
		echo "<script>alert('Invalid Coach id ☹️. Please Enter valid Coach id.')</script>";

	}


	if (isset($_GET['Update_Email'])) {

		$cid = $_GET['Cid'];
		$email = $_GET['Email'];


		if(isvalidCoachId($cid)){
			if (isValidEmail($email)) {


				$sql = "SELECT * FROM coach WHERE COACH_ID = $cid ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "UPDATE coach SET EMAIL = '$email' WHERE COACH_ID = $cid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br>Data Updated";
					}
				}else
				echo "<script>alert('Coach id ".$cid." does not exist in table.')</script>";
			}else
			echo "<script>alert('Invalid Email ☹️. Please Enter valid Email')</script>";
		}else
		echo "<script>alert('Invalid Coach id ☹️. Please Enter valid Coach id.')</script>";

	}


	function isvalidCoachId($id){
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
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z')
			return true;
		else
			return false;
	}


	function isValidEmail($name){
		$bool = true;
		for ($i=0; $i < strlen($name); $i++) { 
			if(!isValidCharacterEmail($name[$i])){
				$bool = false;
				break;
			}
		}
		if ($bool == true) {
			return true;
		}else
		return false;

	}

	function isValidCharacterEmail($char){
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z' || $char = '@' || $char = '.' || $char = '_')
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