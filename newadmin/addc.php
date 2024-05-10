<?php 
session_start();
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];

    $sql_check_account = "SELECT * FROM `useradmin` WHERE `firstname` = ?";
    $stmt_check_account = $con->prepare($sql_check_account);
    $stmt_check_account->bind_param("s", $firstname);
    $stmt_check_account->execute();
    $result_check_account = $stmt_check_account->get_result();

    if ($result_check_account->num_rows > 0) {
        echo '<script>window.location.href = "index.php"; alert("Sorry, you already have an existing account.");</script>';
    } else {
        if (isset($_POST['add'])) {
            $firstname = $_POST['firstname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $company = $_POST['company']; 
            $barangay = $_POST['barangay']; 
            $status = $_POST['status'];

            $codename = generateCodename($company);

            $user_query = "INSERT INTO `useradmin`(`codename`, `firstname`, `username`, `password`, `company`, `barangay`, `status`) VALUES ('$codename','$firstname','$username','$password','$company','$barangay','$status')";

            $user_result = mysqli_query($con, $user_query);

            if ($user_result) {
                $_SESSION['success'] = "Successfully created your account! Your account is currently disabled. Please wait for confirmation via email. Thank you!";
                echo "<script>window.location.href='https://expresswaterrefillwebased.com/admin/login.php'</script>";
            } else {
                $_SESSION['danger'] = "Failed to add account.";
                echo "<script>window.location.href='https://expresswaterrefillwebased.com/admin/login.php'</script>";
            }
        }
    }
}

function generateCodename($company) {
    $random_letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
    return strtoupper($random_letters) . strtoupper(substr($company, 0, 2));
}

?>
