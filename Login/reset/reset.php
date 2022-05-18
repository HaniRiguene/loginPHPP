<?php

include('../resetpassword/checkData.php');

if (isset($_POST['submit'])) {
    $username = checkData($_POST['username']);
    $token = $_POST['token'];

    // check if username and token exists
    $dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
    $stmt = $dbh->prepare("SELECT count(*) FROM users WHERE user_username = :username AND token = :token");
    $stmt->execute(array(':username' => $username, ':token' => $token));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['count(*)'] == 0) {
        header('Location: ../resetpassword?msg=3');
    } else {
        $password = md5(checkData($_POST['password']));
        // update collumn
        $stmt = $dbh->prepare("UPDATE users SET user_password = :password, token = '' WHERE user_username = :username");
        $stmt->execute(array(':password' => $password, ':username' => $username));
        header('Location: ../resetpassword?msg=10');
    }
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>
