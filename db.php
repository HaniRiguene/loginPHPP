<?php

require "config/constants.php";

    $host='localhost';
	$username='root';
	$pass='';
	$db='a&n_shop';

// Create connection
	$con = mysqli_connect($host,$username,$pass,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>