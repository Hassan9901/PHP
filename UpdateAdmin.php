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
	<button><a href="?updatemail_" name="updatemail">Update Email</a></button>
	<button><a href="?updatepassword_" name="updatepassword">Update Password</a></button><br><br>




	<?php 

	if (isset($_GET['updatename_'])) {
		echo "
		<form method='_GET'>
		<label>Admin Id</label>
		<input type='text' name='Adminid'><br><br>
		<label>User Name</label>
		<input type='text' name='name'><br><br>
		<input type='submit' name='Update_name'><br><br>
		</form>
		";
	}

	if (isset($_GET['updatemail_'])) {
		echo "
		<form method='_GET'>
		<label>Admin Id</label>
		<input type='text' name='Adminid'><br><br>
		<label>Email</label>
		<input type='text' name='email'><br><br>
		<input type='submit' name='Update_email'><br><br>
		</form>
		";

	}

	if (isset($_GET['updatepassword_'])) {
		echo "
		<form method='_GET'>
		<label>Admin Id</label>
		<input type='text' name='Adminid'><br><br>
		<label>Password</label>
		<input type='text' name='password'><br><br>
		<input type='submit' name='Update_password'><br><br>
		</form>
		";

	}


	if (isset($_GET['Update_name'])) {
			#echo "string";
		$id = $_GET['Adminid'];
		$name = $_GET['name'];
			#echo "$name<br>";

		if(isvalidId($id)){
			if (isValid($name)) {


				$sql = "SELECT * FROM Admin WHERE ADMIN_ID = '$id' ";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {
					$result = mysqli_fetch_assoc($result);
					$result = $result['USER_NAME'];

					if(strcasecmp($name,$result) != 0){
						$query = "UPDATE Admin SET USER_NAME = '$name' WHERE ADMIN_ID = $id";
						$run = mysqli_query($conn,$query);
						if ($run == true) {
							echo "Data Updated";
						}
					}else
					echo "<script>alert('User name ".$name." already exist.')</script>";
				}else
					echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
			}else
			echo "<script>alert('Invalid user name☹️. Please Enter valid user name')</script>";
		}else
		echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";

	}


	if (isset($_GET['Update_email'])) {
			#echo "string";
		$id = $_GET['Adminid'];
		$email = $_GET['email'];

		if(isvalidId($id)){
			#echo "$name<br>";
		$sql = "SELECT * FROM Admin WHERE ADMIN_ID = '$id' ";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {
			$query = "UPDATE Admin SET EMAIL = '$email' WHERE ADMIN_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Updated";
			}
		}else
		echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
	}else
		echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
	}
	

	if (isset($_GET['Update_password'])) {
			#echo "string";
		$id = $_GET['Adminid'];
		$password = $_GET['password'];
			#echo "$name<br>";
		if(isvalidId($id)){
			$sql = "SELECT * FROM Admin WHERE ADMIN_ID = '$id' ";

			$result = mysqli_query($conn,$sql);

			if (mysqli_num_rows($result) == 1) {
				$query = "UPDATE Admin SET PASSWORD = '$password' WHERE ADMIN_ID = $id";
				$run = mysqli_query($conn,$query);
				if ($run == true) {
					echo "Data Updated";
				}
			}else
			echo "Admin id ".$id." does not exist.";
		}else
		echo "<script>alert('Invalid Admin id ☹️. Please Enter valid Admin id.')</script>";
	}

	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100)
			return true;
	}

	function isValid($username){
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
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z' || $char >= 0 || $char <= 9 ||$char == '@' || $char == '.' || $char == '_')
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