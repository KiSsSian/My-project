<?php
include 'db.php';
session_start();

if($_SESSION['logged_in'] != 1 /*|| $_GET['name'] != 'admin'*/ ){
		header("location: index.php");
}else
	{
if(isset($_POST['submit'])){
	$question_number = $_POST['question_number'];
	$question_chapter = $_POST['chapter'];
	$question_chapter_choices = $_POST['chapter'] . "_choices";
	$question_text = $_POST['question_text'];

	$correct_choices = array();
	$correct_choices[1] = $_POST['correct_choice1'];
	$correct_choices[2] = $_POST['correct_choice2'];
	$correct_choices[3] = $_POST['correct_choice3'];
	$correct_choices[4] = $_POST['correct_choice4'];
	$correct_choices[5] = $_POST['correct_choice5'];

	$choices = array(); 
	$choices[1] = $_POST['choice1'];
	$choices[2] = $_POST['choice2'];
	$choices[3] = $_POST['choice3'];
	$choices[4] = $_POST['choice4'];
	$choices[5] = $_POST['choice5'];

	$sql = "INSERT INTO $question_chapter (question_text) VALUES ('$question_text')";
	$query = $conn->query($sql) or die($conn->error.__LINE__);
	if($query) 
	{
		foreach ($choices as $choice => $value) { // fiecare valoare e verificata sa nu fie goala si daca e varianta corecta
			if($value != ''){
				if(in_array($choice, $correct_choices)){ 
					$is_correct = 1;
				}else {
					$is_correct = 0;
				} // introducem variantele 
			$sql = "INSERT INTO $question_chapter_choices (answer_FK, choice, is_correct) VALUES ('$question_number','$value','$is_correct') ";

			$query = $conn->query($sql) or die($conn->error.__LINE__);

			if($query){
				continue;
			}else{
				die('Error : ('.$conn->errno.')').$conn->error;
			}
		}
		}
		}
}

}
header('location: admin.php');