<?php
require 'db.php';
session_start();
//-----------------------------------------------------------------------------------------------------------
$sql = "SELECT usernamesql FROM users 	 /*Iteram baza de date pentru a seta adminul user-ului cu id-ul=1 */
		WHERE id=1";													
$query = $conn->query($sql) or die($conn->error.__LINE__);	

$admin = $query->fetch_assoc();
$verifyIFadmin = $_GET['login'];        /*selectam din URL numele de utilizator */
if ($verifyIFadmin == $admin['usernamesql']){ /*verificam daca user = admin*/
	header('location: admin.php');           /*redirectionam spre pagina admin*/
}

//-----------------------------------------------------------------------------------------------------------


//------------------aflam numarul total de intrebari pentru a afisa dinamic timpul estimativ-----------------
$sql = "SELECT * FROM questions";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$total = $query->num_rows;
$_SESSION['total'] = $total; //o vom atribui unei superglobale $_SESSION si pentru a o folosi in process.php pentru a stabili daca am ajuns la finalul tabelului cu intrebari.
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
		echo 'Buna <strong>'.$_SESSION['username'].'</strong> esti pregatit sa participi la test ?'.'<br>'.' Sa nu uiti ca e-mailul tau este <u> '.$_SESSION['uemail'].'</u> il poti folosi pentru a te loga data viitoare'; 
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
			<li>Numar de interbari: <?php echo $total; ?></li> <!--Afisam dinamic numarul de intrebarii-->
			<li>Tipul intrebarilor: un singur raspuns corect</li> 
			<li>Timp estimativ: <?php echo $total * 0.5?> minute</li><!--Calculam dinamic pe baza numarului de intrebari -->
		</ul>
		<!--Trimitem ulizatorul catre pagina cu intrebari question.php
		ne vom folosi de n=1 pe pagina question.php unde il redirectionam -->
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