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

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>REZI Quizzer</title>
	<link rel="stylesheet" href="css/profile.css" />
</head>
<body>
	<header>
	<div class="profile-container">
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

		echo 'Buna <strong>'.$_SESSION['username'].'</strong> esti pregatit sa participi la test ?'.'<br><br>'.'Imbunatateste-ti scorul la test iar poza ta de la profil se va schimba :D';
		if(isset($_SESSION['message'])){
			echo '<br><br>'.$_SESSION['message'];
		}
	}
		?>
		</div>
	</header>
		<div class="container">
			<h1>REZI Quizzer</h1>
		</div>

			
		<div>
			<h2>Testeaza-ti cunostintele de REZI</h2>
		</div>
		<p>Acest test are <b>intre 2 si 4 variante de raspuns</b> pentru raspunsurile multiple si <b>1 raspuns corect </b>pentru variantele <u>bifate cu asterix *</u>, foloseste-l pentru a-ti evalua cunostintele inainte de REZI!</p>
		<p style="color: red;"><b>Atentie nu bifa mai mult de 4 variante corecte pentru a avea un scor corespunzator cu cel de la REZI2020</b></p>
		
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
	
</div>
</html>

<?php 
$_SESSION['score'] = 0;
}
?>