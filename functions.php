<?php
include("config.php");

class func
 {
     private $pdo ;
     public function __construct(){
        $this->pdo =  new PDO('mysql:host=localhost;dbname=securelogin','root','');
     }

    public function checkLoginState()
    {
        $stmt=$this->pdo->prepare("SELECT * FROM users;");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            echo $row['user_username'];
        }
//        if(!isset($_SESSION['id'])||!isset($_COOKIE['PHPSESSID']))
//        {
//       // session_start();
//        }
//        if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial']))
//        {
//            $query = "SELECT * FROM sessions WHERE :userid = sessions_userid AND sessions_token = :token AND sessions_serial = :serial;";
//            $userid=$_COOKIE['userid'];
//            $token=$_COOKIE['token'];
//            $serial=$_COOKIE['serial'];
//            $stmt=$dbh->prepare($query);
//            $stmt->execute(array(':userid'=>$userid,':token'=>$token,':serial'=>$serial));
//            $row=$stmt->fetch(PDO::FETCH_ASSOC);
//            if ($row['sessions_userid']>0)
//            {
//              if (
//                  $row['sessions_userid'] == $_COOKIE['userid'] &&
//                  $row['sessions_token'] == $_COOKIE['token'] &&
//                  $row['sessions_serial'] == $_COOKIE['serial'] )
//              {
//                  if (
//                      $row['sessions_userid'] == $_COOKIE['userid'] &&
//                      $row['sessions_token'] == $_COOKIE['token'] &&
//                      $row['sessions_serial'] == $_COOKIE['serial']
//                  )
//                  {
//                      return true;
//                  }
//              }
//            }
//        }
    }
    public static function createString($string): string
    {
        return md5($string) . rand(10, 9999);
    }
 }
