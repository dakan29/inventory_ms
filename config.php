<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'inventory_ms';

$conn = mysqli_connect($servername, $username, $password, $dbname);

//check if conn is successful

if (!$conn){
    die("Database connection is unsuccessful<br>".mysqli_connect_error());

}
?>