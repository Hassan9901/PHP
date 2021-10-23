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
		<label>Event Id</label>
		<input type="text" name="Eventid"><br><br>
		<label>Event Name</label>
		<input type="text" name="Eventname"><br><br>
		<label>Year</label>
		<input type="text" name="Year"><br><br>
		<label>Format</label>
		<input type="text" name="format"><br><br>
		<label>Country Id</label>
		<input type="text" name="Countryid"><br><br>
		<input type="submit" name="submit"><br><br>
		
	</form>


	<?php 

	if(isset($_POST['submit'])){
		$id = $_POST['Eventid'];
		$name = $_POST['Eventname'];
		$year = $_POST['Year'];
		$format = $_POST['format'];
		$cid = $_POST['Countryid'];

		if(isvalidId($id)){
			if(isValidName($name)){
				if (isvalidYear($year)) {
					if (isValidName($format)) {
						if (isvalidCID($cid)) {
							
							$sq = "SELECT * FROM country WHERE COUNTRY_ID = $cid";
							$re = mysqli_query($conn,$sq);
							if (mysqli_num_rows($re) > 0) {	
								
								$sql = "INSERT INTO event_ (EVENT_ID,EVENT_NAME, YEAR,FORMAT, COUNTRY_ID) VALUES ($id,'$name', $year, '$format', $cid)";
								
								$result = mysqli_query($conn,$sql);

								if($result == 1)
									echo "Data added.";
								else{
									echo "string";
									$sql2 = "SELECT * FROM event_ WHERE EVENT_ID = $id";
									$result2 = mysqli_query($conn,$sql2);
									if (mysqli_num_rows($result2) == 1) {
										echo "Event ID ".$id." already exist in table.";
									}
								}
							}else
							echo "Country id ".$cid." does not exist in country table.";	
						}else
						echo "<script>alert('Invalid Country id ☹️. Please Enter valid Country id')</script>";
					}else
					echo "<script>alert('Invalid Fromat ☹️. Please Enter valid Format')</script>";
				}else
				echo "<script>alert('Invalid year ☹️. Please Enter valid year')</script>";
			}else
			echo "<script>alert('Invalid Event name ☹️. Please Enter valid Event name.')</script>";
		}else
		echo "<script>alert('Invalid Event id ☹️. Please Enter valid Event id.')</script>";

	}

	function isvalidId($id){
		$id = (int) $id;
		if($id > 0 && $id < 100000)
			return true;
	}

	function isvalidYear($year){
		$id = (int) $year;
		if($year > 2015 && $year < 3000)
			return true;
	}

	function isvalidNofTeams($no){
		$id = (int) $no;
		if($no > 4 && $no < 20)
			return true;
	}

	function isvalidCID($id){
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
		if($char >= 'a' || $char <= 'z' || $char >= 'A' || $char <= 'Z' || $char >= 0 || $char <= 9)
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


