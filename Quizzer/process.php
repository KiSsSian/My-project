<?php 
include 'db.php';
session_start();

	if(!isset($_SESSION['score'])) {
		$_SESSION['score'] = 0;
	}
	if($_POST){
		$number = $_POST['number']; //$number de aici are valoarea primita din URL si e expediata prin metoda POST din formular
		$selected_choice = $_POST['choice'];
		
		$next=$number+1;

	$sql = "SELECT * FROM choices
		 WHERE  question_number=$number AND is_correct=1";

	$query = $conn->query($sql) or die($conn->error.__LINE__);
	$row = $query->fetch_assoc();
	$correct_choice = $row['id'];

	if($selected_choice == $correct_choice){
		$_SESSION['score'] = $_SESSION['score']+1;
		
	}

	if($number == $_SESSION['total']){
		header('location: final.php');
		exit();
	}else{
		header('location: question.php?n=2');
	}
}