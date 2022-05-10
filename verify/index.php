<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
// recover token 
$token = $_GET['token'];

// check if token exists in users tab
$dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
$stmt = $dbh->prepare("SELECT count(*) FROM users WHERE token = :token");
$stmt->execute(array(':token' => $token));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['count(*)']==0){
    header('Location: ../login?msg=6');
} else {
    // reset token and set user_status to 1 and verification_date = date('Y-m-d H:i:s')
    $stmt = $dbh->prepare("UPDATE users SET token = '', user_status = 1, verification_date = NOW() WHERE token = :token");
    $stmt->execute(array(':token' => $token));
    header('Location: ../login?msg=7');
}