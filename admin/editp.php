<?php
session_start();
require '../connection.php';

if (isset($_POST['edit'])) {
    $type = $_POST['type'];
    $price = $_POST['price'];
    $product_id = $_POST['product_id'];

    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image'];
        $fileName = $image['name'];
        $fileTmpName = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileError = $image['error'];
        $fileType = $image['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'webp');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 52428800) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = "../upload/" . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $image = $fileDestination;
                } else {
                    echo "Error: File size is too large.";
                    exit; 
                }
            } else {
                echo "Error: There was an error uploading your file.";
                exit; 
            }
        } else {
            
            echo "Error: Invalid file type.";
            exit;
        }
    } else {
        
        $image = $_POST['original_image'];
    }

    $query = "UPDATE `products` SET 
        `type`='$type',
        `price`='$price',
        `image`='$image'
        WHERE `product_id`='$product_id'";

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['success'] = "Successfully Updated";
        header("Location: products.php");
        exit;
    } else {
        $_SESSION['danger'] = "Failed to Update";
        header("Location: products.php?product_id=$product_id");
        exit;
    }
}
?>
