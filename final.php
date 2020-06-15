<?php
session_start();
require 'db.php';
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
			<h1>PHP Quizzer</h1>
		</div>
	</header>
	<main>
		<div class="current">
			<h2>Ai terminat !</h2>
		</div>
				<p> Felicitari ! </p>
				<p>Scor final: <?php echo $_SESSION['score']; //afisam scorul
				
//------------------------------------------------------------------------------------------------------------------------------
		$user = $_SESSION['username'];
		$finalscore = $_SESSION['score'];
//-------selectam username si scorul--------------------------------------------------------------------------------------------
		$checkexists = $conn->query("SELECT usernamesql, score FROM users WHERE usernamesql='$user'");
		$row = $checkexists->fetch_assoc();
//-------comparam scorul din test cu scorul obtinut in trecut, daca e nou inregistrat are 0 prestablit--------------------------			
				if($finalscore > $row['score']){
					$sql = $conn->query("UPDATE users SET score=$finalscore WHERE usernamesql='$user'");
				}	
//------eliberam variabila pentru a nu cumula scorul----------------------------------------------------------------------------			
				unset($_SESSION['score']);
?> 
				</p>
				<form method="POST" action="leaderboard.php">
				<input type="submit" value="LEADERBOARD">
				</form>
	</main>
	<footer>
		<div class="container">
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>