<?php
session_start();
var_dump($_SESSION);
require '../connection.php';

if (isset($_POST['edit'])) {
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_id = $_POST['user_id'];

 
    $query = "UPDATE `users` SET 
        `fullname`=?,
        `address`=?,
        `contact`=?,
        `username`=?,
        `password`=?,
        `email`=?
        WHERE `user_id`=?";

    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
      
        mysqli_stmt_bind_param($stmt, 'ssssssi', $fullname, $address, $contact, $username, $password, $email, $user_id);
        mysqli_stmt_execute($stmt);

      
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = "Successfully Updated";
            header("Location: myprofile.php");
            exit;
        } else {
            $_SESSION['danger'] = "Failed to Update";
            header("Location: myprofile.php?user_id=$user_id");
            exit;
        }
    } else {
     
        $_SESSION['danger'] = "Failed to Update";
        header("Location: myprofile.php?user_id=$user_id");
        exit;
    }
}
?>
