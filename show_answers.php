<script language="javascript" type="text/javascript">
		window.history.forward();
</script>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/profile.css" />
	
</head>
<body>

<?php 
session_start();
header("Cache-Control: no cache");
echo 'Your selected answers are: '.'<br>';

foreach ($_SESSION['selected_choice_text'] as $key => $value) {
	echo $value;
	echo '<br>';

	unset($_SESSION['selected_choice_text'][$key]);

}

if($_SESSION['number']< $_SESSION['total_questions']){
?>

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