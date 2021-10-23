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
		<label>Player Id</label>
		<input type="text" name="Pid"><br><br>
		<label>First Name</label>
		<input type="text" name="fn"><br><br>
		<label>Last Name</label>
		<input type="text" name="ln"><br><br>
		<label>Email</label>
		<input type="text" name="Email"><br><br>
		<label>DOB</label>
		<input type="date" name="dob"><br><br>
		<label>Role</label>
		<input type="text" name="role"><br><br>
		<label>Team Id</label>
		<input type="text" name="tid"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$pid = $_POST['Pid'];
		$fn = $_POST['fn'];
		$ln = $_POST['ln'];
		$Email = $_POST['Email'];
		$dob = $_POST['dob'];
		$role = $_POST['role'];
		$tid = $_POST['tid'];

		// $q1 = "SELECT * from team WHERE team_id = $tid";
		// $r1 = mysqli_query($conn,$q1);

		if(isvalidId($pid)){
			if(isValidName($fn)){
				if(isValidName($ln)){
					if (isValidEmail($Email)) {
						if(isValidName($role)){
							if (isvalidId($tid)) {
								//player id not placed 
								$sql = "INSERT INTO `player` (`PLAYER_ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `DOB`, `TYPE`, `TEAM_ID`) VALUES ($pid, '$fn', '$ln', '$Email', '$dob', '$role', $tid);";

								$result = mysqli_query($conn,$sql);

								if($result == 1)
									echo "Data added.";
								else{
									$sql2 = "SELECT * FROM `player` WHERE PLAYER_ID = $pid";
									$result2 = mysqli_query($conn,$sql2);
									if (mysqli_num_rows($result2) > 0) 
										echo "Player id ".$pid." already exist in table.";

									$sql3 = "SELECT * FROM `team` WHERE TEAM_ID = $tid";
									$result3 = mysqli_query($conn,$sql3);
									if (!mysqli_num_rows($result3) > 0) 
										echo "Team id ".$tid." does not exist in team table.";
								}
							}else
							echo "<script>alert('Invalid Team Id. ☹️. Please Enter valid Team id')</script>";
						}else
						echo "<script>alert('Invalid Role ☹️. Please Enter valid Role')</script>";
					}else
					echo "<script>alert('Invalid Email ☹️. Please Enter valid Email')</script>";
				}else
				echo "<script>alert('Invalid last name ☹️. Please Enter valid last name.')</script>";
			}else
			echo "<script>alert('Invalid Firts name☹️. Please Enter valid First name')</script>";
		}else
		echo "<script>alert('Invalid Player id ☹️. Please Enter valid Player id.')</script>";
	}


	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 10000)
			return true;
	}

	function isValidName($username){
		$bool = true;
		for ($i=0; $i < strlen($username); $i++) { 
			if(!isValidCharacter($username[$i])){
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


	function isValidEmail($username){
		$bool = true;
		for ($i=0; $i < strlen($username); $i++) { 
			if(!isValidCharacterEmail($username[$i])){
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
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z' || $char >= 0 || $char <= 9 || $char == '@' || $char == '.' || $char == '_')
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


