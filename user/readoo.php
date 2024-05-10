<?php

require '../connection.php';


if (isset($_POST['usersearch'])) {
    $uservaluesearch = $_POST['uservaluesearch'];

    $user_query = "SELECT u.useradmin_id, u.fullname, u.contact, u.barangay, b.houseno, b.purok, b.street, t.ref_number, t.payment_type, t.products_sold, t.amount, t.status, t.category, t.date, t.reason
                    FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id'
                    AND (CONCAT(u.fullname, u.barangay, b.houseno, b.purok, b.street, t.ref_number) LIKE '%$uservaluesearch%') ORDER BY t.date DESC";
    $user_result = mysqli_query($con, $user_query);
} else {

    $user_query = "SELECT u.useradmin_id, u.fullname, u.contact, u.barangay, b.houseno, b.purok, b.street, t.ref_number, t.payment_type, t.products_sold, t.amount, t.status, t.category, t.date, t.reason
                    FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id' ORDER BY t.date DESC";
    $user_result = mysqli_query($con, $user_query);
}


?>