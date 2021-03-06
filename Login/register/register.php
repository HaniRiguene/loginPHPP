<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;

include '../send.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    // check if username exists
    $dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
    $stmt = $dbh->prepare("SELECT count(*) FROM users WHERE user_username = :username");
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($row['count(*)'] != 0) {
        // check if existing account is verified
        $stmt = $dbh->prepare("SELECT user_status FROM users WHERE user_username = :username");
        $stmt->execute(array(':username' => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['user_status'] == 1) {
            header('Location: ../login?msg=9');
        } else {
            // generate token
            $token = md5(uniqid(rand(), true));
            // update token in users table
            $stmt = $dbh->prepare("UPDATE users SET token = :token WHERE user_username = :username");
            $stmt->execute(array(':token' => $token, ':username' => $username));
            // send email
            $verification_mail = "http://localhost/Hani/Login/verify?token=" . $token;
            (sendmail("HAni app", $username, "reLien de Verification", "Cliquez sur ce lien pour vérifier l'e-mail '.$verification_mail.'"));
            header('Location: ../login?msg=10');
        }
    } else {
        $token = md5($username) . rand(0, 9999);
        $verification_mail = "http://localhost/Hani/Login/verify?token=" . $token;
        $dateTime = date('Y-m-d H:i:s');
        $stmt = $dbh->prepare("INSERT INTO users (user_username, user_password, token, creation_date) VALUES (:username, :password, :token, :dateTime)");
        $stmt->execute(array(':username' => $username, ':password' => $password, ':token' => $token, ':dateTime' => $dateTime));
        echo('thanks for registreing please verify your account we have been sending a verification mail');
        echo('<br>');
        echo'<a href="../login/" class="form-control btn btn-login">return to login page</a>';
        
    }
}

?>

