<?php 
session_start();
require '../connection.php';

if (isset($_POST['add'])) {
    $image = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 52428800) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = "../upload/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "Error";
            }
        } else {
            echo "Error";
        }
    } else {
        echo "Error";
    }

    $useradmin_id = $_SESSION['useradmin_id']; // Assuming useradmin_id is stored in the session

    $type =  $_POST['type'];  
    $price =  $_POST['price']; 

    $user_query = "INSERT INTO `products`(`image`, `type`, `price`, `useradmin_id`) 
                   VALUES ('$fileDestination', '$type','$price','$useradmin_id')";

    $user_result = mysqli_query($con, $user_query);

    if ($user_result) {
        $_SESSION['success'] = "Successfully Added!";
        echo "<script>window.location.href='products.php'</script>";
    } else {
        $_SESSION['danger'] = "Failed to Add";
        echo "<script>window.location.href='products.php'</script>";
    }
}
?>
