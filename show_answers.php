<script language="javascript" type="text/javascript">
		window.history.forward();
</script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Raspunsurile tale</title>
	<link rel="stylesheet" href="css/profile.css" />
	
</head>
<body>

<?php 
session_start();
header("Cache-Control: no cache");
if(isset($_SESSION['question_text'])){
echo '<b><u>Raspunsurile tale</b></u> la intrebarea: '.'<br>'.'<br>'.'<b>'.$_SESSION['question_text'].'</b>'.'<br>';
}
foreach ($_SESSION['selected_choice_text'] as $key => $value) {
	if($value){
	echo '<br>';
	echo '&#128151;'.$value;
	echo '<br>';

	unset($_SESSION['selected_choice_text'][$key]);
	

}
}

if($_SESSION['number']< $_SESSION['total_questions']){
?>
<hr style="width:50%"><br>

<?php 
if (isset($_SESSION['question_text'])) {

echo '<b><u>Raspunsurile CORECTE </b></u> la intrebarea: '.'<br>'.'<br>'.'<b>'.$_SESSION['question_text'].'</b>'.'<br>';
}

foreach ($_SESSION['correct_choice_text'] as $key => $value) {
	if($value){
	echo '<br>';
	echo '&#128151;'.$value;
	echo '<br>';
}
unset($_SESSION['question_text']);
unset($_SESSION['correct_choice_text'][$key]);
}

?>	
	<br>
	<form method="POST" action="question.php">
		<input type="submit" name="button_next" value="NEXT QUESTION">
	</form>


<?php 
}
	
	if($_SESSION['number'] == $_SESSION['total_questions']){

	?>
<p> You finished the test, congrats!! Head for the final page</p>
<a href="final.php"> FINAL PAGE</a>

<?php	
}

?>

</body>
</html>