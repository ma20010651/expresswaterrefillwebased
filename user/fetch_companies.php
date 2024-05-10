<?php

require '../connection.php';

if (isset($_POST['barangay'])) {
    handleBarangayRequest($con, $_POST['barangay']);
} else {
    echo 'Invalid request';
}

function handleBarangayRequest($con, $barangay) {
    $barangay = $con->real_escape_string($barangay);

    $sql = "SELECT company FROM `useradmin` WHERE barangay = '$barangay' AND status = 'Active'";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $companies = array();
        while ($row = $result->fetch_assoc()) {
            $companies[] = $row['company'];
        }
        echo implode(', ', $companies);
    } else {
        echo 'No companies found for this barangay';
    }

    $con->close();
}
?>
