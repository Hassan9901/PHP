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
		<label>Admin Id</label>
		<input type="text" name="Adminid"><br><br>
		<label>User Name</label>
		<input type="text" name="Username"><br><br>
		<label>Email</label>
		<input type="text" name="Email"><br><br>
		<label>Password</label>
		<input type="text" name="Password"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

		if(isset($_POST['submit'])){
			$Adminid = $_POST['Adminid'];
			$username = $_POST['Username'];
			$Email = $_POST['Email'];
			$Password = $_POST['Password'];
			
			if(isvalidId($Adminid)){
				if(isValid($username)){
					if (isValid($Email)) {
						if (isValid($Password)) {
							$sql = "INSERT INTO Admin (ADMIN_ID,USER_NAME,EMAIL,PASSWORD) 
									VALUES ($Adminid,'$username','$Email','$Password')";

							$result = mysqli_query($conn,$sql);

							if($result == 1)
								echo "Data added.";
							else{
								$sql2 = "SELECT * FROM Admin WHERE ADMIN_ID = '$Adminid'";
								$result2 = mysqli_query($conn,$sql2);
								if (mysqli_num_rows($result2) > 0) {
									echo "Admin ID ".$Adminid." already exist in table.";
								}

								$sql3 = "SELECT * FROM Admin WHERE USER_NAME = '$username'";
								$result3 = mysqli_query($conn,$sql3);
								if (mysqli_num_rows($result3) > 0) 
									echo "User name ".$username." already exist in table.";
							}
						}else
							echo "<script>alert('Invalid Password ☹️. Please Enter valid Password')</script>";
					}else
						echo "<script>alert('Invalid Email ☹️. Please Enter valid Email')</script>";
				}else
					echo "<script>alert('Invalid user name☹️. Please Enter valid user name')</script>";
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


