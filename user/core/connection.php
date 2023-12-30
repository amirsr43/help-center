<?php
date_default_timezone_set('Asia/Jakarta');

$databaseHost = 'localhost';
$databaseName = 'user_db';
$databaseUsername = 'root';
$databasePassword = '';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if(mysqli_connect_errno()){
    echo "failed connect to mysql ".mysqli_connect_error(); 
}
?>