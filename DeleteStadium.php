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
 		<button name="logout">Log Out</button><br>
 	</form>
	
	<form method="_POST">
		<label>Stadium ID</label>
		<input type="text" name="sid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$id = $_GET['sid'];

		$sql = "SELECT * FROM Stadium WHERE STADIUM_ID = $id ";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {

			$query = "DELETE FROM Stadium WHERE STADIUM_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Deleted";
			}
		}else
			echo "Stadium id ".$id." does not exist in table.";


	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

	 ?>


</body>
</html>