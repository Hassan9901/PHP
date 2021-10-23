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
		<label>Coach Id</label>
		<input type="text" name="cid"><br><br>
		<label>Firts Name</label>
		<input type="text" name="fn"><br><br>
		<label>Last Name</label>
		<input type="text" name="ln"><br><br>
		<label>Email</label>
		<input type="text" name="email"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$cid = $_POST['cid'];
		$fn = $_POST['fn'];
		$ln = $_POST['ln'];
		$email = $_POST['email'];

		if(isvalidCoachId($cid)){
			if(isValidName($fn)){
				if (isValidName($ln)) {
					if (isValidEmail($email)) {
						
						AddCoach($conn,$cid,$fn,$ln,$email);

					}else
					echo "<script>alert('Invalid email ☹️. Please Enter valid email')</script>";
				}else
				echo "<script>alert('Invalid Last name ☹️. Please Enter valid Last name')</script>";
			}else
			echo "<script>alert('Invalid First name ☹️. Please Enter valid First name.')</script>";
		}else
		echo "<script>alert('Invalid Coach id ☹️. Please Enter valid Coach id')</script>";
	}


	function AddCoach($conn,$cid,$fn,$ln,$email){

		$sql = "INSERT INTO coach (COACH_ID,FIRST_NAME,LAST_NAME,EMAIL) VALUES ($cid,'$fn','$ln','$email')";
		$run = mysqli_query($conn,$sql);

		if($run == 1)
			echo "Data added.";
		else{
			$sql2 = "SELECT * FROM coach WHERE COACH_ID = $cid";
			$result2 = mysqli_query($conn,$sql2);
			if (mysqli_num_rows($result2) > 0) {
				echo "Coach ID ".$cid." already exist in table.";
			}
		}
		
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
