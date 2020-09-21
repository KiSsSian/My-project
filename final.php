<?php
session_start();
header("Cache-Control: no cache");
require 'db.php';

if($_SESSION['logged_in'] != 1){
		header("location: index.php");
}else
	{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>PHP Quizzer</title>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>
	<header>
		<div class="container">
			<h1>REZI Quizzer</h1>
		</div>
	</header>
	<main>
		<div class="current">
			<h2>Ai terminat !</h2>
		</div>
				<p> Felicitari ! </p>
				<p>Scor final: <?php echo $_SESSION['score']; 
				

		$user = $_SESSION['username'];
		$finalscore = $_SESSION['score'];

		$checkexists = $conn->query("SELECT usernamesql, score FROM users WHERE usernamesql='$user'");
		$row = $checkexists->fetch_assoc();

				if($finalscore > $row['score']){
					$sql = $conn->query("UPDATE users SET score=$finalscore WHERE usernamesql='$user'");
				}	

				echo '<br>';
				echo round(($_SESSION['score']*100)/($_SESSION['num_rows']*5)).' %';
						
			
				// unset($_SESSION['score']);
				// unset($_SESSION['percentage']);
				// $_SESSION['logged_in'] = 0;
				
		}?> 
				</p>
				<form method="POST" action="leaderboard.php">
				<input type="submit" value="LEADERBOARD" class="start">
				</form>
	</main>
	<footer>
		<div class="container">
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>