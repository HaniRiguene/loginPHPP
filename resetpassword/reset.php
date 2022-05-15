<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
     
include '../send.php';
include 'checkData.php';
if (isset($_POST['submit'])) {
    $username = checkData($_POST['username']);
    // check if username exists
    $dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
    $stmt = $dbh->prepare("SELECT count(*) FROM users WHERE user_username = :username");
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['count(*)'] == 0) {
        header('Location: ../resetpassword?msg=3');
    } else {
        // generate token
        $token = md5(uniqid(rand(), true));
        // update token in users table
        $stmt = $dbh->prepare("UPDATE users SET token = :token WHERE user_username = :username");
        $stmt->execute(array(':token' => $token, ':username' => $username));
        // send email
        $verification_mail = "http://localhost/Hani/Login/reset?token=" . $token;
        (sendmail("HAni app", $username, "reLien de Verification", "Cliquez sur ce lien pour reset le mot de passe '.$verification_mail.'"));
         header('Location: ../resetpassword?msg=10');
}
}
// $stat=0;
// if (isset($_GET['token'])){
// 	$token = $_GET['token'];
//     $sql = "SELECT * FROM users WHERE recovery=:token";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([
//         'token' => $token,
//     ]);
//     $row=$stmt->rowCount();
//     if ($row){
//         if (isset($_POST['password'])){
//             $password = md5(checkData($_POST['password']));
//             $email = checkData($_POST['email']);
//             if (filter_var($email, FILTER_VALIDATE_EMAIL)){
//                 $sql = "SELECT * FROM users WHERE recovery=:token AND email=:user_username";
//                 $stmt = $pdo->prepare($sql);
//                 $stmt->execute([
//                     'token' => $token,
//                     'email' => $email,
//                 ]);
//                 if ($stmt->rowCount()){
//                     $sql = "UPDATE users set password =:user_password,recovery =NULL WHERE email=:user_username";
//                     $stmt = $pdo->prepare($sql);
//                     $stmt->execute([
//                         'email' => $email,
//                         'pass' => $password,
//                     ]);
//                     $stat=1;
//                 }
//                 else{
//                     $stat=2;
//                 }
//             }else{
//                 $stat=3;
//             }
            
// 	}
// }else{
// 	$stat=2;
// }}
             
