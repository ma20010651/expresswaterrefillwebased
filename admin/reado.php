<?php
require '../connection.php';


$useradmin_id = $_SESSION['useradmin_id'];

$user_query = "SELECT * FROM `order` WHERE useradmin_id = '$useradmin_id' ORDER BY id DESC";

$user_result = mysqli_query($con, $user_query);


if (!$user_result) {
    echo "Error: " . mysqli_error($con);
   
} else {

}
?>
