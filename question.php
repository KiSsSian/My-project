<?php
include 'db.php';
session_start();
header("Cache-Control: no cache");

if($_SESSION['logged_in'] != 1){
		header("location: index.php");
}else
	{
		

		

		if(!isset($_POST['capitol']) and isset($_POST['submit'])) {
			header('location: capitol.php');
		}
		if(isset($_POST['capitol']) and isset($_POST['submit'])) {
		list($chapter_selected,$chapter_answers) = explode('|', $_POST['capitol']);
		
		$_SESSION['raspunsuri_capitol'] = $chapter_answers;
		$_SESSION['x'] = $chapter_selected;
		$_SESSION['y'] = $chapter_answers;
		$_SESSION['number'] = 1;
		
		}
echo '<b>Username: </b>'.$_SESSION['username']; 
$chapter_selected2=$_SESSION['x'];
$chapter_answers2=$_SESSION['y'];



$sql="SELECT * FROM $chapter_selected2";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$result = $query->fetch_assoc();
$num_rows = $query->num_rows;
$_SESSION['total_questions'] = $num_rows;


$sql = "SELECT * FROM $chapter_answers2 WHERE answer_FK='".$_SESSION['number']."' ";
$choices = $conn->query($sql) or die($conn->error.__LINE__); 

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
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>
	</header>
	<main>	
		<div>
			<div class="current"> Question <?php echo $_SESSION['number'];?> out of <?php echo $num_rows;?> </div>
			<p>
			<?php 
			
			$sql="SELECT question_text FROM $chapter_selected2 WHERE id_question='".$_SESSION['number']."' ";
			$query = $conn->query($sql) or die();
			$result = $query->fetch_assoc();

				echo $result['question_text']; ?>
						</p>
				<form method="POST" action="process.php">
					<ul>
						<?php $i=0; ?>	
						<?php while($row = $choices->fetch_assoc()){ 
						?> 
						
					<li><input type="hidden" name="choice[<?= $i ?>]" value="0" autocomplete="off"></li>	
					<li><input type="checkbox" name="choice[<?= $i ?>]" value="1" autocomplete="off"><?= $row['choice'];?></li>

						<?php $i++;

					}
					}
					?>
							
					</ul>
	
		<input type="submit" value="SUBMIT" class="start">
		<input type="hidden" name="number" value="<?php echo $_SESSION['number'];?>">
		</form>	
	</div>
	</main>
</body>
	<footer>
			<div class="footer">
				Copyright &copy; 2020, PHP Quizzer
			</div>
	</footer>

</html>
