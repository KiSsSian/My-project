<?php
include 'db.php';
session_start();

$_SESSION['backbrowser'] = true;

$sql="SELECT * FROM nume_capitol";
$query= $conn->query($sql);
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Captiole</title>
		<link rel="stylesheet" href="css/profile.css" />
	</head>
	<body>
	
	
<form method="POST" action="question.php">

	<?php
	while($chapter_name= $query-> fetch_assoc()){
	?>

	<ul>
	<li><input type="radio" name="capitol" value="<?php echo $chapter_name['nume_capitol'];?>|<?php echo $chapter_name['nume_variante'];?>"><?php echo $chapter_name['nume_capitol'];?>
	</li>
	
	</ul>
<?php
}
?>
<input type="submit" name="submit" value="SUBMIT" class="start">
</form>
</body>
<footer>
	<div class="footer">
	Copyright &copy; 2020, PHP Quizzer
	</div>
</footer>
</html>