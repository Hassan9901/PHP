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
	<br>
	<button><a href="?updatename_" name="updatename">Update First Name</a></button>
	<button><a href="?updatemail_" name="updatemail">Update Email</a></button>
	<button><a href="?updatedob_" name="updatedob">Update DOB</a></button>
	<button><a href="?updaterole_" name="updaterole">Update Role</a></button>
	<button><a href="?updateimage_" name="updateimage">Update image</a></button>
	<button><a href="?updatetid_" name="updatetid">Update Team Id</a></button><br><br>




	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='pid'><br><br>
		<label>Player Name</label>
		<input type='text' name='name'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	if (isset($_GET['updatemail_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='pid'><br><br>
		<label>Email</label>
		<input type='text' name='email'><br><br>
		<input type='submit' name='Update_email'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatedob_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='pid'><br><br>
		<label>DOB</label>
		<input type='date' name='dob'><br><br>
		<input type='submit' name='Update_dob'><br><br>
		</form>
		";

	}

	if (isset($_GET['updaterole_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='pid'><br><br>
		<label>Role</label>
		<input type='text' name='role'><br><br>
		<input type='submit' name='Update_role'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatetid_'])) {
		echo "
		<form method='_GET'>
		<label>Player Id</label>
		<input type='text' name='pid'><br><br>
		<label>Team Id</label>
		<input type='text' name='tid'><br><br>
		<input type='submit' name='Update_tid'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_name'])) {
		$id = $_GET['pid'];
		$name = $_GET['name'];
			#echo "$name<br>";

		if(isvalidId($id)){
			if (isValidName($name)) {


				$sql = "SELECT * FROM player WHERE PLAYER_ID = '$id' ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$result = mysqli_fetch_assoc($result);
					$result = $result['FIRST_NAME'];

					if(strcasecmp($name,$result) != 0){
						$query = "UPDATE player SET FIRST_NAME = '$name' WHERE PLAYER_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else
					echo "<script>alert('Player name ".$name." already exist.')</script>";
				}else
				echo "<script>alert('Player id".$id." does not exist. Please Enter valid Player id.')</script>";
			}else
			echo "<script>alert('Invalid Player name☹️. Please Enter valid Player name')</script>";
		}else
		echo "<script>alert('Invalid Player id ☹️. Please Enter valid Player id.')</script>";

	}


	if (isset($_GET['Update_email'])) {
			#echo "string";
		$id = $_GET['pid'];
		$email = $_GET['email'];

		if(isvalidId($id)){
			if (isValidEmail($email)) {
				
			#echo "$name<br>";
				$sql = "SELECT * FROM player WHERE PLAYER_ID = $id";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE player SET EMAIL = '$email' WHERE PLAYER_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}

				}else
				echo "<script>alert('Player id".$id." does not exist. Please Enter valid Player id.')</script>";
			}else
			echo "<script>alert('Invalid email ☹️. Please Enter valid email.')</script>";
		}else
		echo "<script>alert('Invalid player id ☹️. Please Enter valid player id.')</script>";
	}
	


	if (isset($_GET['Update_dob'])) {
			#echo "string";
		$id = $_GET['pid'];
		$dob = $_GET['dob'];
			#echo "$name<br>";
		if(isvalidId($id)){
			$sql = "SELECT * FROM player WHERE PLAYER_ID = $id ";

			$result = mysqli_query($conn,$sql);

			if (mysqli_num_rows($result) == 1) {
				$query = "UPDATE player SET DOB = '$dob' WHERE PLAYER_ID = $id";
				$run = mysqli_query($conn,$query);
				echo "".$run;
				if ($run == true) {
					echo "Data Updated";
				}
			}else
			echo "Player id ".$id." does not exist.";
		}else
		echo "<script>alert('Invalid Player id ☹️. Please Enter valid player id.')</script>";
	}

	if (isset($_GET['Update_role'])) {
			#echo "string";
		$id = $_GET['pid'];
		$role = $_GET['role'];

		if(isvalidId($id)){
			if (isValidName($role)) {
				
			#echo "$name<br>";
				$sql = "SELECT * FROM player WHERE PLAYER_ID = $id";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE player SET TYPE = '$role' WHERE PLAYER_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Updated";
					}

				}else
				echo "<script>alert('Player id".$id." does not exist. Please Enter valid Player id.')</script>";
			}else
			echo "<script>alert('Invalid email ☹️. Please Enter valid email.')</script>";
		}else
		echo "<script>alert('Invalid player id ☹️. Please Enter valid player id.')</script>";
	}

	if (isset($_GET['Update_tid'])) {
		
		$id = $_GET['pid'];
		$tid = $_GET['tid'];

		if(isvalidId($id)){
			// new function to make for validation of tid
			if (isvalidId($tid)) {

				$sql = "SELECT * FROM player WHERE PLAYER_ID = $id";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$query = "UPDATE player SET TEAM_ID = $tid WHERE PLAYER_ID = $id";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "<br><br>Data Updated";
					}else
					echo "<script>alert('Team id ".$tid." does not exist in table Team.')</script>";	
				}else
				echo "<script>alert('Player id ".$id." does not exist in table.')</script>";
			}else
			echo "<script>alert('Invalid Team id ☹️. Please Enter valid Team id.')</script>";
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

	?>


</body>
</html>