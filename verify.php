<?php 

require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $_GET['email']; 
    $hash = $_GET['hash']; 
    
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
      echo "Contul a fost deja verificat sau URL-ul este invalid";    
    }
    else {
             
        // Set the user status to active (active = 1)
        $conn->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        unset($_SESSION['message']);
        header("location: profile.php?login=".$_SESSION['username']);
    }
}
else {
    echo "Parametri trimisi nu sunt valizi !";

}     
?>