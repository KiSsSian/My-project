<?php
require 'db.php';
session_start();
	if($_SESSION['logged_in'] != 1){
		header("location: index.php");
}else
	{
//-----------------------------------------------------------------------------------------------------------
$sql = "SELECT usernamesql FROM users 	 /*Iteram baza de date pentru a seta adminul user-ului cu id-ul=1 */
		WHERE id=1";													
$query = $conn->query($sql) or die($conn->error.__LINE__);	
$admin = $query->fetch_assoc();
if(isset($_GET['login'])){
$verifyIFadmin = $_GET['login'];        /*selectam din URL numele de utilizator */
if ($verifyIFadmin == $admin['usernamesql']){ /*verificam daca user = admin*/
	header('location: admin.php?name=admin');           /*redirectionam spre pagina admin*/
}
}
//-----------------------------------------------------------------------------------------------------------


//------------------aflam numarul total de intrebari pentru a afisa dinamic timpul estimativ-----------------
$sql = "SELECT * FROM questions";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$total = $query->num_rows;
$_SESSION['total'] = $total; //o vom atribui unei superglobale $_SESSION si pentru a o folosi in process.php pentru a stabili daca am ajuns la finalul tabelului cu intrebari.
//-----------------------------------------------------------------------------------------------------------

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


		$sql = "SELECT * FROM users ";													
		$query = $conn->query($sql) or die($conn->error.__LINE__);
		if($query->num_rows > 0)
		{
			while($profileimage = $query->fetch_assoc())
			{

			if($profileimage['usernamesql'] == $_SESSION['username'])
				{

					if($profileimage['score'] == 0){

						echo "<img class='profileimage'src='uploads/cainele.jpg'><br>";
			}
					if($profileimage['score'] == 1){

						echo "<img class='profileimage'src='uploads/alien.png'><br>";
			}
					if($profileimage['score'] == 2){

						echo "<img class='profileimage'src='uploads/mortysister.png'><br>";
			}
					if($profileimage['score'] == 3){

						echo "<img class='profileimage'src='uploads/morty.png'><br>";
			}
					if($profileimage['score'] == 4){

						echo "<img class='profileimage'src='uploads/rick.png'><br>";
			}
					if($profileimage['score'] >= 5){ //atunci ca adaugam mai multe intrebari

						echo "<img class='profileimage'src='uploads/images.png'><br>";
			}
			
		}
	}

		echo 'Buna <strong>'.$_SESSION['username'].'</strong> esti pregatit sa participi la test ?'.'<br><br>'.'Imbunatateste-ti scorul la test pentru a castiga un avatar din seria Rick&Morty.';
		if(isset($_SESSION['message'])){
			echo '<br><br>'.$_SESSION['message'];
		}
	}
		?>
		</div>
	</header>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>

			
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
		<div class="container">
		<a href="capitol.php" class="start">START!</a> 
		<form action="logout.php">
		<input class="signout" type="submit" value="LOGOUT" action="logout.php">
		</form>
		</div>
	
</body>
	<footer>
			<div class="footer">
				Copyright &copy; 2020, PHP Quizzer
			</div>
	</footer>
	

</html>

<?php }?>