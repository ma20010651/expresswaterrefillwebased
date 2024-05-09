<?php


$host = 'localhost';
$username = 'u139123658_waterstation';
$password = 'Qoobeeagapi04';
$database = 'u139123658_waterstation';

$con = mysqli_connect($host, $username, $password, $database);


if(mysqli_connect_errno()){
	echo "Failed to connect" . mysqli_connect_errno();
}
?>