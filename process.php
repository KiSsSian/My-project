<?php 
include 'db.php'; 
session_start(); //incepem sesiunea pentru a ne putea folosi de superglobala $_SESSION

	if(!isset($_SESSION['score'])) { //daca nu exista atunci o cream si ii atribuim valoarea 0
		$_SESSION['score'] = 0;
	}
	if(isset($_POST['choice']) || $_POST['choice'] == ''){ 
		$number = $_POST['number']; //$number de aici are valoarea primita prin metoda POST prin input-ul cu name='number' din formular
		$selected_choice = $_POST['choice']; //$selected_choice are valoarea id-ului din tabelul choices
		
		$next=$number+1; // il folosim sa redirectionam utilizatorul (catre intrebarea numarul 2,3,4 etc)

	$sql = "SELECT * FROM choices
		 	WHERE  question_number=$number AND is_correct=1";
	$query = $conn->query($sql) or die($conn->error.__LINE__);
	$row = $query->fetch_assoc(); //iteram baza de date si obtinem un associative array pe baza criteriului $number si is_correct=1
	$correct_choice = $row['id']; //$correct_choice are valoarea id-ului raspunsului corect din tabelul choices

	if($selected_choice == $correct_choice){ // comparam id-ul raspunsului ales cu id-ul raspunsului corect
		$_SESSION['score'] = $_SESSION['score']+1; //daca e corect incrementam scorul cu 1 si ne folosim de o superglobala pentru a o putea folosi in final.php
		
	}

	if($number == $_SESSION['total']){ //daca am ajuns la ultima intrebare mergem la pagina final.php
						
			header ('location: final.php');
	}else{
		header('location: question.php?n='.$next); // daca nu, redirectionam catre question.php cu n incrementat o singura data (adica spre location: question.php?n=2)
	}
}