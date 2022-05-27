<?php
$host_name = "localhost";
$database = "my_db"; // Change your database name
$username = "userid";        // Your database user id 
$password = "password";        // Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>