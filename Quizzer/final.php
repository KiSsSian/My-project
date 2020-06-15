<?php
session_start();
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
				<p>Scor final: <?php echo $_SESSION['score'];
				unset($_SESSION['score']);?>
				</p>
				<a href="question.php?n=1" class="start">Take Again</a>
	</main>
	<footer>
		<div class="container">
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>