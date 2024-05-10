 <?php

include 'model.php';

$applicant = new Applicant();

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $rows = $applicant->date_range($start_date, $end_date);
} else {
    $rows = $applicant->fetch();
}

echo json_encode($rows);