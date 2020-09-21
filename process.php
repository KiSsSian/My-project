<?php 
include 'db.php'; 
session_start();
	

$chapter_answers = $_SESSION['raspunsuri_capitol'];


$next=$_SESSION['number']+1;


	if(!isset($_SESSION['score'])) { 
		$_SESSION['score'] = 0;
	}

	if(isset($_POST['choice']) || $_POST['choice'] == ''){ 
									 
			$selected_choice=$_POST['choice'];

			foreach ($selected_choice as $key => $value) {
				
				if($value != 0 || $value != NULL){
			
			list($sort,$_SESSION['selected_choice_text'][]) = explode('|', $value);
				}
								
		} 


			$sql = "SELECT * FROM $chapter_answers WHERE  answer_FK='".$_SESSION['number']."' ";
		 	$query = $conn->query($sql) or die($conn->error.__LINE__);
		 						
			while($row = $query->fetch_assoc()){
				$correct_choice[]=$row['is_correct'];
				$_SESSION['raspunsuri_corecte'][]=$row['choice'];
			
			}
				for ($i=0; $i <=4 ; $i++) { 
					
			if($selected_choice[$i] === $correct_choice[$i])
				{
					 $_SESSION['score']= $_SESSION['score']+1;
				} 
			}
header("location: show_answers.php");	
}



?>