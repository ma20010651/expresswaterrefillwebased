<?php 
session_start();
require '../connection.php';

if (isset($_GET['userdelete'])) {

$useradmin_id = $_GET['useradmin_id'];

$del_query = "DELETE FROM `useradmin` WHERE useradmin_id='$useradmin_id'";

$del_result = mysqli_query($con,$del_query);

	if ($del_result) {
		$_SESSION['success'] = "Successfully Deleted";
		echo "<script>window.location.href='clients.php' </script>";
	} else{
		$_SESSION['danger'] = "Failed to Delete";
		echo "<script>window.location.href='clients.php' </script>";
	}
}

?>
