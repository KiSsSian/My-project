<?php
require 'db.php';
session_start();

echo '<b>Username: </b>'.$_SESSION['username']; 

$number = (int) $_GET['n'];

//------iteram baza de date pentru a obtine numarul intrebarii ce e egal cu numarul n din URL si pentru a afisa intrebarea

$sql="SELECT * FROM questions WHERE question_number = $number";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$result = $query->fetch_assoc();

//------------------iteram baza de date pentru a avea acces la PK pentru a-l folosi in while ------------------------

$sql="SELECT * FROM choices WHERE question_number = $number";
$choices = $conn->query($sql) or die($conn->error.__LINE__);
?>

<!------------------------------------------------------------------------------------------------------------------>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Quizzer</title>
	<link rel="stylesheet" href="css/profile.css" />
</head>
<body>
	<header>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>
	<main>	
		<div class="container">
			<div class="current"> Question <?php echo $number;?> out of <?php echo $_SESSION['total'];?> </div>
			<p>
			<?php echo $result['text']; ?>
						</p>
				<form method="POST" action="process.php">
					<ul>

			<!-------------Selectam fiecare rand din tabel pana obtinem o valoare NULL si o redam ca input radio in HTML---------->
			<!-------------Se va atribui fiecarui input id-ul din tabelul choices prin value=script, asa stim alegerea facuta de utilizator pe care o vom compara mai departe cu raspunsul corect------------------------------------------------------>

						<?php while($row = $choices->fetch_assoc()): ?>
						<li><input type="radio" name="choice" value="<?php echo $row['id'];?>"><?php echo $row['text'];?></li>
						<?php endwhile; ?>
							
					</ul>
	
		<input type="submit" value="SUBMIT"><!-- de ce e hidden si cred ca e pentru a avea 2xvalue-->
		<input type="hidden" name="number" value="<?php echo $number; ?>">
		</form>	
	</div>
	</main>

	<footer>
			<div class="footer">
				Copyright &copy; 2020, PHP Quizzer
			</div>
	</footer>
	</header>
</body>
</html>