<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$host = "localhost";
$database = "securelogin";// Change your database name
$username = "root";      // Your database user id 
$password = "";      // Your password

//error_reporting(0);// With this no error reporting will be there
///// Do not Edit below //////
$connection=mysqli_connect($host,$username,$password,$database);
if (!$connection) {
    echo "Error: Unable to connect to MySQL.<br>";
    echo "<br>Debugging errno: " . mysqli_connect_errno();
    echo "<br>Debugging error: " . mysqli_connect_error();
    exit;
}
?>  