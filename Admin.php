<?php 

include("connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])	?>">
 		<button name="logout">Log Out</button>
 	</form>
 -->
	<form method="POST" action="AddAdmin.php">
		<button type = "submit" name="Add">Add Admin</button>		
	</form><br>

	<form method="_POST" action="UpdateAdmin.php">
		<button type="submit" name="update">Update Admin data</button>
	</form><br>

	<form method="_POST" action="DeleteAdmin.php">
		<button type="submit" name="delete">Delete Admin</button><br><br>
	</form>

	<?php 
	$sql = "SELECT * FROM Admin";

	$result = mysqli_query($conn,$sql);

	if($result->num_rows > 0){

		echo "
		<table border = 2px solid> 
		<tr>
		<th>Admin ID</th>
		<th>User Name</th>
		<th>Email</th>
		<th>Password</th>
		</tr>";

		while($row = $result->fetch_assoc()){

			echo "	<tr>
			<td>".$row["ADMIN_ID"]."</td>
			<td>".$row["USER_NAME"]."</td>
			<td>".$row["EMAIL"]."</td>
			<td>".$row["PASSWORD"]."</td>

			</tr>";	
		}

		echo "</table>";
	}

	if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

	// if(isset($_POST['Add'])){
	// 	include('AddAdmin.php');		
	// }
	// if (isset($_POST['update'])) {
	// 	include('UpdateAdmin.php');
	// }


	?>


</body>
</html>

