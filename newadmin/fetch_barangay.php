<?php
require '../connection.php';

if(isset($_POST['client'])) {
    $selectedClient = $_POST['client'];

    list($firstname, $lastname) = explode(' ', $selectedClient);

    $barangaySql = "SELECT DISTINCT barangay FROM `applicant` WHERE `firstname` = ? AND `lastname` = ? AND `status` = 1 ORDER BY `id` ASC";
    $barangayStmt = $con->prepare($barangaySql);
    $barangayStmt->bind_param("ss", $firstname, $lastname);
    $barangayStmt->execute();
    $barangayResult = $barangayStmt->get_result();

    $companySql = "SELECT DISTINCT company FROM `applicant` WHERE `firstname` = ? AND `lastname` = ? AND `status` = 1 ORDER BY `id` ASC";
    $companyStmt = $con->prepare($companySql);
    $companyStmt->bind_param("ss", $firstname, $lastname);
    $companyStmt->execute();
    $companyResult = $companyStmt->get_result();

    $response = [
        'barangay' => [],
        'company' => []
    ];

    if ($barangayResult && $barangayResult->num_rows > 0) {
        while ($row = $barangayResult->fetch_assoc()) {
            $response['barangay'][] = $row['barangay'];
        }
    }

    if ($companyResult && $companyResult->num_rows > 0) {
        while ($row = $companyResult->fetch_assoc()) {
            $response['company'][] = $row['company'];
        }
    }

    echo json_encode($response);
    
    $barangayStmt->close();
    $companyStmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
