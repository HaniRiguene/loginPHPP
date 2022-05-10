<?php
// error php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
     
use PHPMailer\PHPMailer\PHPMailer;

include '../send.php';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);


    $dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
    $stmt = $dbh->prepare("SELECT count(*) FROM users WHERE user_username = :username");
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($row['count(*)'] == 0) {
     header('Location: ../login?msg=3');
    } else {
        $stmt = $dbh->prepare("SELECT * FROM users WHERE user_username = :username");
        $stmt->execute(array(':username' => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['user_password'] == $password) {
            
 session_start();
            if ($row['user_status'] == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                header('Location: ../');
            } else {
                // generate token
                $token = md5(uniqid(rand(), true));
                // update token in users table
                $stmt = $dbh->prepare("UPDATE users SET token = :token WHERE user_username = :username");
                $stmt->execute(array(':token' => $token, ':username' => $username));
                // send email
                $verification_mail = "http://localhost/Hani/Login/verify?token=" . $token;
                (sendmail("Hani app", $username, "reLien de Verification", "Cliquez sur ce lien pour vérifier l'e-mail '.$verification_mail.'"));
               header('Location: ../login?msg=10');
            }
        } else {
              header('Location: ../login?msg=4');
        }
    }
    
}


