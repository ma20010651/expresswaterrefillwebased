<?php 
session_start();
require '../connection.php';

if (isset($_POST ['add'])) {
 
 $codename =  $_POST['codename'];
 $company =  $_POST['company'];  
 $address =  $_POST['address'];
 $fullname =  $_POST['fullname'];
 $contact =  $_POST['contact'];  
 $username =  $_POST['username']; 
 $password =  $_POST['password'];
 $usertype =  $_POST['usertype'];

$user_query = "INSERT INTO `usersuperadmin`(`codename`, `company`, `address`, `fullname`, `contact`, `username`, `password`, `usertype` ) VALUES ('$codename','$company','$address','$fullname','$contact','$username','$password','$usertype')";

$user_result = mysqli_query($con,$user_query);

if($user_result){

	 	$_SESSION['success'] = "Successfully Added!";
	 	echo"<script>window.location.href='clients.php'</script>";
	 }else{
	 	$_SESSION['danger'] = "Failed to Add";
	 	echo"<script>window.location.href='clients.php'</script>";
	 }
}
?>
