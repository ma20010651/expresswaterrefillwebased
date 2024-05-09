<?php
session_start();
require 'connection.php';

function uploadFile($file, $destination) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 52428800) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = "upload/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                return $fileDestination;
            } else {
                return "Error: File size is too large";
            }
        } else {
            return "Error: There was an error uploading your file";
        }
    } else {
        return "Error: Invalid file type";
    }
}

if (isset($_POST['submit'])) {
    $image = uploadFile($_FILES['image'], "image");
    $validid = uploadFile($_FILES['validid'], "validid");
    $dti = uploadFile($_FILES['dti'], "dti");

    if (substr($image, 0, 5) === "Error" || substr($validid, 0, 5) === "Error" || substr($dti, 0, 5) === "Error") {
        echo $image . "<br>" . $validid . "<br>" . $dti;
    } else {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middle = $_POST['middle'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $unit = $_POST['unit'];
        $street = $_POST['street'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $plan = $_POST['plan'];
        $status = $_POST['status'];

        $user_query = "INSERT INTO `applicant`(`image`, `validid`, `dti`, `firstname`, `lastname`, `middle`, `age`, `gender`, `contact`, `unit`, `street`, `barangay`, `city`, `country`, `zip`, `company`, `email`, `plan`, `status` ) VALUES ('$image', '$validid', '$dti', '$firstname','$lastname','$middle','$age','$gender','$contact','$unit','$street','$barangay','$city','$country','$zip','$company','$email','$plan','$status')";

        $user_result = mysqli_query($con, $user_query);

        if ($user_result) {
            $_SESSION['success'] = "Successfully Added!";
            echo "<script>window.location.href='applysuccess.php'</script>";
        } else {
            $_SESSION['danger'] = "Failed to Add";
            echo "<script>window.location.href='applysuccess.php'</script>";
        }
    }
}
?>
