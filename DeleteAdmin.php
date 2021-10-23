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
	
	<form method="_POST">
		<label>Admin ID</label>
		<input type="text" name="Adminid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$id = $_GET['Adminid'];

		$sql = "SELECT * FROM Admin WHERE ADMIN_ID = '$id' ";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {

			$query = "DELETE FROM Admin WHERE ADMIN_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Updated";
			}
		}else
			echo "Admin id ".$id." does not exist.";


	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

	 ?>


</body>
</html>