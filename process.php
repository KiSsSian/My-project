<?php 
include 'db.php'; 
	session_start();
	


$chapter_answers = $_SESSION['raspunsuri_capitol'];
$number = $_GET['n'];
$next=$number+1;
	if(!isset($_SESSION['score'])) { 
		$_SESSION['score'] = 0;
	}
	if(isset($_POST['choice']) || $_POST['choice'] == ''){ 

			
			
				 
			$selected_choice=$_POST['choice'];
			
			$sql = "SELECT is_correct FROM $chapter_answers
		 	WHERE  answer_FK=$number ";

		 	$query = $conn->query($sql) or die($conn->error.__LINE__);
		 						
			while($row = $query->fetch_assoc()){
				$correct_choice[]=$row['is_correct'];
			
			}
				for ($i=0; $i <=3 ; $i++) { 
					
			if($selected_choice[$i] === $correct_choice[$i])
				{
					 $_SESSION['score']= $_SESSION['score']+1;
				} 
			}
	
}
if($number == $_SESSION['total_questions']){

	header("location: final.php");

}else{

header("location: question.php?n=$next");

}
?>