<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "apoteksehat";
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'apoteksehat');
 
$link = mysqli_connect($hostname, $username, $password, $database);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>