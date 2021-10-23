<?php 

include("connection.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])	?>">
		<input type="text" name="username" placeholder="Username"><br><br>
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="signin">Sign in.</button>
	</form>

<?php 

if (isset($_POST['signin'])) {

	#trim removes spaces before and after
	#stripslashes removes slashes in a string
	#htmlspecialchars converts html tags into some other number and string
	$user = htmlspecialchars(stripcslashes(trim($_POST['username'])));
	$pass = $_POST['password'];

	#Escaping special symbols fro use in sql query
	$user = mysqli_real_escape_string($conn,$user);
	$pass = mysqli_real_escape_string($conn,$pass);
	
	#query template
	#$query = "SELECT * from admin where username = '$user' and password = '$pass'";
	$query = "SELECT * from admin where user_name = ? and password = ?";

	#preparin query
	$prep = mysqli_prepare($conn,$query);
	if($prep){
		mysqli_stmt_bind_param($prep,"ss",$user,$pass);
		mysqli_stmt_execute($prep);
		mysqli_stmt_store_result($prep);
		
		if(mysqli_stmt_num_rows($prep) == 1){
			session_start();
			$_SESSION['Username'] = $_POST['username'];
			header("location: Adminpanel.php");	
		}else{
			echo "<script>alert('Incorrect Username or Password')</script>";	
		}
	}

	// $result = mysqli_query($conn,$query);

	// $count = mysqli_num_rows($result);

	// if($count == 1){
		
	// }else{
		
	// }

}
 ?>


</body>

</html>



