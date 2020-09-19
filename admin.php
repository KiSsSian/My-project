<?php
include 'db.php';
session_start();

if($_SESSION['logged_in'] != 1 || $_GET['name'] != 'admin' ){
		header("location: index.php");
}else
	{
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>PHP Quizzer</title>
	<link rel="stylesheet"  href="css/profile.css">
</head>
<body>
	<header>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>
	</header>

		<div class="admincurrent">
			<h2>Adauga o intrebare</h2>
		<?php
			if(isset($msg))
				echo '<p>'.$msg.'</p>';
		?>
		</div>
			<form method="POST" action="admin_process.php">
				<p>Capitolul in care vrei sa introduci intrebarea: </p>
					
					<?php 
					$sql = "SELECT * FROM nume_capitol";
					$chapters = $conn->query($sql) or die();
					$total_chapters = $chapters->num_rows;

					if($total_chapters>0){ ?>
						
						
						<?php while($result = $chapters->fetch_assoc()){ ?>
							 <input name="chapter" type="radio" value="<?php echo $result['nume_capitol']; ?>"><?php echo $result['nume_capitol']; ?>

						<?php } ?>


					<?php } ?>
					
				
				<p>
					<label>Numarul intrebarii: </label>
					<input type="number" name="question_number" />
				</p>
				<p>
					<label>Intrebarea: </label>
					<input type="text" name="question_text" />
				</p>
				<p>
					<label>Varianta #1: </label>
					<input type="text" name="choice1" />
				</p>
				<p>
					<label>Varianta #2: </label>
					<input type="text" name="choice2" />
				</p>
				<p>
					<label>Varianta #3: </label>
					<input type="text" name="choice3" />
				</p>
				<p>
					<label>Varianta #4: </label>
					<input type="text" name="choice4" />
				</p>
				<p>
					<label>Varianta #5: </label>
					<input type="text" name="choice5" />
				</p>
				<p>
					<label>Varianta corecta: </label>
					<input type="number" name="correct_choice1" />
					<input type="number" name="correct_choice2" />
					<input type="number" name="correct_choice3" />
					<input type="number" name="correct_choice4" />
					<input type="number" name="correct_choice5" />
				</p>
				<input type="submit" value="SUBMIT" name="submit">
			</form>
		
	
	<footer>
		<div>
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>
<?php } ?> 