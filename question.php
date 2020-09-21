<script language="javascript" type="text/javascript">
		window.history.forward();
</script>
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
		list($chapter_selected,$chapter_answers) = explode('|', $_POST['capitol']); //selectam tabelul cu intrebarile in $chapter_selected si tabelul cu raspunsrui in $chapter_answers
		
		$_SESSION['raspunsuri_capitol'] = $chapter_answers;
		$_SESSION['tabel_intrebari'] = $chapter_selected;
		$_SESSION['tabel_raspunsuri'] = $chapter_answers;
		$_SESSION['number'] = 1;
		
		}

		

echo '<b>Username: </b>'.$_SESSION['username']; 

$chapter_selected2=$_SESSION['tabel_intrebari'];
$chapter_answers2=$_SESSION['tabel_raspunsuri'];

//iteram baza de date pentru a afla nr total de intrebari din capitol
$sql="SELECT * FROM $chapter_selected2";
$query = $conn->query($sql) or die($conn->error.__LINE__);
$result = $query->fetch_assoc();
$num_rows = $query->num_rows;
$_SESSION['num_rows'] = $num_rows;
$_SESSION['total_questions'] = $num_rows;

if(isset($_POST['button_next']))
{
$_SESSION['number']++;
 header('Location: ' . $_SERVER['PHP_SELF']); 
} 

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
			<h1>REZI2020 Quizzer</h1>
		</div>
	</header>
	<main>	
		<div class="container-question">
			<div class="current"> Question <?php echo $_SESSION['number'];?> out of <?php echo $num_rows;?> </div>
			<p>
			<?php 
			
			$sql="SELECT question_text FROM $chapter_selected2 WHERE id_question='".$_SESSION['number']."' ";
			$query = $conn->query($sql) or die();
			$result = $query->fetch_assoc();

				echo $result['question_text']; 
				$_SESSION['question_text'] = $result['question_text'];
				?>
			</p>
				<form method="POST" action="process.php">
					<ul>
						<?php $i=0; ?>	
						<?php while($row = $choices->fetch_assoc()){ 
						?> 
						
					<li><input type="hidden" name="choice[<?= $i ?>]" value="0" autocomplete="off"></li>	
					<li><input type="checkbox" name="choice[<?= $i ?>]" value="1|<?= $row['choice'];?>" autocomplete="off"><?= $row['choice'];?></li>

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
<?php
if(isset($_SESSION['score'])){
echo '<br>'.'Your score is:  '.$_SESSION['score'].' out of '.($num_rows*5).' correct ';
$percentage =round(($_SESSION['score']*100)/($num_rows*5));
echo '<br>'.$percentage.' % ';
$_SESSION['percentage'] = $percentage;

unset($_SESSION['back_browser']);
}
?>