<?php
session_start();
if(isset($_POST['login'])){
 
require '../db.php';

$emaillogin = $_POST['email'];
$passwordlogin = $_POST['password'];
if(empty($emaillogin) || empty($passwordlogin)){

header("location: ../index.php?error=emptyfields&mail=".$emaillogin);
		exit();
	}
		elseif (!filter_var($emaillogin, FILTER_VALIDATE_EMAIL)){
			header("location: ../index.php?error=invlaidMail");
			exit();
	}
		

else{
	$sql = "SELECT * FROM users WHERE email=?";
	$stmt = $conn->prepare($sql);
	if(!$stmt){
		header("location: ../index.php?error=sqlerror");
		exit();
	}

	else{

		$stmt->bind_param("s", $emaillogin);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc(); 

		if(empty($row)){

			header("location: ../index.php?error=nosuchemail");
		}
			elseif (!empty($row) || $row['email']=$emaillogin){

				$pwdCheck = password_verify($passwordlogin, $row['password']);

					if ($pwdCheck == false){
						header("location: ../index.php?error=wrongpwd");
						exit();
					}

					elseif ($pwdCheck == true){
						
						$_SESSION['uemail'] = $row['email'];
						$_SESSION['username'] =$row['usernamesql'];
						header("location: ../profile.php?login=".$_SESSION['username']);// introducem in URL cine e utilizatorul pentru a-l redirectiona de pe profile.php pe admin.php in cazul in care este admin.
						exit();
					}

					else {
						header("location: ../index.php?error=noUser;");
						exit();
					}
			}

		}
	}
}