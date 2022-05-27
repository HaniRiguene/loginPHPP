<?php
$host_name = "localhost";
$database = "chart_data"; // Change your database name
$username = "root";        // Your database user id 
$password = "";        // Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>