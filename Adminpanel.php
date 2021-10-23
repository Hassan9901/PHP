<?php 

include('connection.php');
session_start();
session_regenerate_id(true);
if(!isset($_SESSION['Username'])){
	header("location: AdminLogin.php");
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Admin Panel</title>
 </head>
 <body>
 	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])	?>">
 		<button name="logout">Log Out</button>
 	</form>

 <!-- 	<h1>Welcome <?php echo $_SESSION['Username']; ?></h1> -->




 	<p><a href="?link1" name="Dashboard">Dashboard</a></p>
 	<button><p><a href="?Admin" name="Admin">Admins</a></p></button><br><br>
 	<button><p><a href="?Event" name="Event">Events</a></p></button><br><br>
 	<button><p><a href="?Team" name="Team">Teams</a></p></button><br><br>
 	<button><p><a href="?Players" name="Player">Players</a></p></button><br><br>
 	<button><p><a href="?Match" name="Match">Match</a></p></button><br><br>
 	<button><p><a href="?Coach" name="Coach">Coaches</a></p></button><br><br>
	<button><p><a href="?Country" name="Country">Countries</a></p></button><br><br>
 	<button><p><a href="?City" name="City">Cities</a></p></button><br><br>
 	<button><p><a href="?Stadium" name="Stadium">Stadiums</a></p></button><br><br>
 	<button><p><a href="?Organizes" name="Organize">Organize Events</a></p></button><br><br>
 	<button><p><a href="?Participate" name="Participate">Participate in Event (Team)</a></p></button><br><br>
 	<button><p><a href="?Plays" name="Plays">Match played (Player)</a></p></button><br><br>
 	<button><p><a href="?Played_By" name="playedby">Match played (Team)</a></p></button><br><br>
 
 	

 	<?php 

 		if(isset($_POST['logout'])){
 			session_destroy();
 			header("location: AdminLogin.php");
 		}

 		#$link = $_GET('link');
 		
 		if(isset($_GET['Admin'])){
 			include('Admin.php');
 			
 		}

 		if(isset($_GET['Event'])){
 			include('Event.php');
 		}

 		if(isset($_GET['Country'])){
 			include('Country.php');
 		}

 		if(isset($_GET['Organizes'])){
 			include('Organizes.php');
 		}

 		if(isset($_GET['City'])){
 			include('City.php');
 		}

 		if(isset($_GET['Stadium'])){
 			include('Stadium.php');
 		}

 		if(isset($_GET['Coach'])){
 			include('Coach.php');
 		}

 		if(isset($_GET['Players'])){
 			include('Player.php');
 		}

 		if(isset($_GET['Match'])){
 			include('Match.php');
 		}

 		if(isset($_GET['Team'])){
 			include('Team.php');
 		}

 		if(isset($_GET['Participate'])){
 			include('Participate.php');
 		}

 		if(isset($_GET['Plays'])){
 			include('PB_Player.php');
 		}

 		if(isset($_GET['Played_By'])){
 			include('PB_Team.php');
 		}

 	 ?>

 </body>
 </html>