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
		<label>Country ID</label>
		<input type="text" name="Countryid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$id = $_GET['Countryid'];

		$sql = "SELECT * FROM Country WHERE COUNTRY_ID = $id ";

		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) == 1) {

			$query = "DELETE FROM Country WHERE COUNTRY_ID = $id";
			$run = mysqli_query($conn,$query);
			if ($run == true) {
				echo "Data Deleted";
			}
		}else
			echo "Country id ".$id." does not exist.";


	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

	 ?>


</body>
</html>