<?php
/* 
1.Daca utilizatorul a apasat pe butonul de inregistrare din index atunci: 
*/

if(isset($_POST['register'])){
include_once '../db.php'; 

/*
Crestem vizibilitatea prin transferul datelor introduse de utilizator in variabile
*/

$username = $_POST['usernamehtml'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordRepeat = $_POST['password-repeat'];

/*
Verificam daca datele introduse de utilizator in input-ul din index.php
*/

	if (empty($username) || empty($email) || empty($password)) 
		/*daca oricare din cele 3 input-uri sunt goale atunci ne oprim si returnam un URL de care ne folosim mai tarziu pentru a prelua input-urile care nu sunt goale */
	{
		header("location: ../index.php?error=emptyfields&username=".$username."&mail=".$email);
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
		 header("location: ../index.php?error=invlaidMail&Username");
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("location: ../index.php?error=invlaidMail&username=".$username);
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
		header("location: ../index.php?error=invalidUsername&mail=".$email);
		exit();
	}
	elseif ($password !== $passwordRepeat){
		header("location: ../index.php?error=passwordRepeat&username=".$username."&mail=".$email);
		exit();
	}
	
		$sql = "SELECT * FROM users WHERE email=? OR usernamesql=? LIMIT 1" or die($mysqli->error());
		$stmt = $conn->prepare($sql);
    	$stmt->bind_param('ss', $email, $username);
    	$stmt->execute();
    	$result = $stmt->get_result();
    	
		if ( $result->num_rows > 0 ) { 
			header("location: ../index.php?error=usernameTaken");
		}
		else{

    		$sql = "INSERT INTO users (usernamesql, email, password) VALUES (?,?,?)";
		
			if($stmt = $conn->prepare($sql)){
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$stmt->bind_param("sss", $username, $email, $hash);
					$stmt->execute();

					session_start();
					 $_SESSION['uemail'] = $email; 
					 $_SESSION['username'] = $username;
					 
					header("location: ../profile.php?login=".$_SESSION['username']);
					exit();
					

			}}}
			else {
				$conn->error();
    			exit();
			}
		
	
	


?>