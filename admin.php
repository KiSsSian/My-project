<?php
include 'db.php';
session_start();

if($_SESSION['logged_in'] != 1 || $_GET['name'] != 'admin' ){
		header("location: index.php");
}else
	{
if(isset($_POST['regintrebare'])){
	$question_number = $_POST['question_number'];
	$question_text = $_POST['question_text'];
	$correct_choice =$_POST['correct_choice'];
	$choices = array(); //cream un associative array pe care il folosim in foreach
	$choices[1] = $_POST['choice1'];
	$choices[2] = $_POST['choice2'];
	$choices[3] = $_POST['choice3'];
	$choices[4] = $_POST['choice4'];

	//introducem in baza de date intrebarea
	$sql = "INSERT INTO questions (question_number, text) 
				VALUES ('$question_number','$question_text')";
	$query = $conn->query($sql) or die($conn->error.__LINE__);
	if($query) 
	{
		foreach ($choices as $choice => $value) { // fiecare valoare e verificata sa nu fie goala si daca e varianta corecta
			if($value != ''){
				if($correct_choice == $choice){ 
					$is_correct = 1;
				}else {
					$is_correct = 0;
				} // introducem variantele 
			$sql = "INSERT INTO choices (question_number, is_correct, text) 
				VALUES ('$question_number', '$is_correct', '$value')";

			$query = $conn->query($sql) or die($conn->error.__LINE__);

			if($query){
				continue;
			}else{
				die('Error : ('.$conn->errno.')').$conn->error;
			}
		}
		}
		$msg ='Intrebarea a fost adaugata';
	}
}

$sql = "SELECT * FROM questions";
$questions = $conn->query($sql) or die($conn->error.__LINE__);
$total = $questions->num_rows;
$next = $total+1;
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
			<form method="POST" action="admin.php">
				
				<p>
					<label>Numarul intrebarii: </label>
					<input type="number" value="<?php echo $next; ?>" name="question_number" />
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
					<label>Varianta corecta: </label>
					<input type="number" name="correct_choice" />
				</p>
				<input type="submit" value="SUBMIT">
			</form>
		
	
	<footer>
		<div>
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>
<?php } ?> 