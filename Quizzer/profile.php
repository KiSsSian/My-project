<?php
require 'db.php';
session_start();

$uemail = $_SESSION['uemail'];
$user = $_SESSION['username'];

//------------------aflam numarul total de intrebari pentru a afisa dinamic timpul estimativ----------
$sql = "SELECT * FROM questions";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$total = $query->num_rows;
$_SESSION['total'] = $total;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Quizzer</title>
	<link rel="stylesheet" href="css/profile.css" />
</head>
<body>
	<header>
		<div class="somedetails">	
		<?php
		echo 'Hello '.$user.' are you ready to take the quizz ?'.'<br>'.' Just so you know, your email is '.$uemail.' you can use it to log in next time';
		?>
		</div>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>

	<main>			
		<div>
			<h2>Testeaza-ti cunostintele de PHP</h2>
		</div>
		<p>Acest test are variante multiple de raspuns dar doar unul este corect, foloseste-l pentru a-ti evalua cunostintele de baza in PHP7!</p>
		<ul>
			<li>Numar de interbari: <?php echo $total; ?></li>
			<li>Tipul intrebarilor: un singur raspuns corect</li>
			<li>Timp estimativ: <?php echo $total * 0.5?> minute</li>
		</ul>
		<a href="question.php?n=1" class="start">START!</a>
	</main>

	<footer>
			<div class="footer">
				Copyright &copy; 2020, PHP Quizzer
			</div>
	</footer>
	</header>
</body>
</html>