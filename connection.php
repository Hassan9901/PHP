<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "databse_project";

$conn = mysqli_connect($server,$username,$password,$database);
if(mysqli_connect_error()){
	echo "<script>alert('connection failure')</script>";
}



 ?>