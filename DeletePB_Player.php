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
		<label>Match ID</label>
		<input type="text" name="Mid"><br><br>
		<label>Player ID</label>
		<input type="text" name="Pid"><br><br>
		<input type="submit" name="Delete">
	</form>

	<?php 

	if (isset($_GET['Delete'])) {
		$Mid = $_GET['Mid'];
		$Pid = $_GET['Pid'];

		if (isvalidMId($Mid)) {
			if (isvalidPId($Pid)) {
				
				$sql = "SELECT * FROM plays WHERE MATCH_ID = $Mid && PLAYER_ID = $Pid";

				$result = mysqli_query($conn,$sql);

				if (mysqli_num_rows($result) == 1) {

					$query = "DELETE FROM plays WHERE MATCH_ID = $Mid && PLAYER_ID = $Pid";
					$run = mysqli_query($conn,$query);
					if ($run == true) {
						echo "Data Deleted";
					}
				}else{
					$query = "SELECT * FROM plays WHERE MATCH_ID = $Mid";
					$execute = mysqli_query($conn,$query);
					if (mysqli_num_rows($execute) > 0) {
						echo "<script>alert('Player id ".$Pid." does not exist in table plays with Match id ".$Mid."')</script>";
					}else{
						$query = "SELECT * FROM plays WHERE PLAYER_ID = $Pid";
						$execute = mysqli_query($conn,$query);
						if (mysqli_num_rows($execute) > 0) {
							echo "<script>alert('Match id ".$Mid." does not exist in table plays with Player id ".$Pid."')</script>";
						}else
						echo "<script>alert('Match id ".$Mid."  and Player id ".$Pid." does not exist in table plays.')</script>";	
					}
				}
			}else
			echo "<script>alert('Invalid Player id☹️. Please Enter valid Player id')</script>";
		}else
		echo "<script>alert('Invalid Match id☹️. Please Enter valid Match id')</script>";
	}

	if(isset($_POST['logout'])){
		session_destroy();
		header("location: AdminLogin.php");
	}

	function isvalidMId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}


	function isvalidPId($id){
		$id = (int) $id;
		if($id > 0 && $id < 10000)
			return true;
	}



	?>


</body>
</html>