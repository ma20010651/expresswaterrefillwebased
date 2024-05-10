<?php

require __DIR__ . '/../connection.php';


if (isset($_POST['usersearch'])) {
    $uservaluesearch = $_POST['uservaluesearch'];

    $user_query = "SELECT * FROM `plans` WHERE CONCAT(`title`) LIKE '%" . $uservaluesearch . "%' AND `status` = 1";
    $user_result = mysqli_query($con, $user_query);
} else {
    $user_query = "SELECT * FROM `plans` WHERE `status` = 1";

    $user_result = mysqli_query($con, $user_query);
}


?>
