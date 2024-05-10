<?php

include 'models.php';

$online = new Online();

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $rows = $online->date_range($start_date, $end_date);
} else {
    $rows = $online->fetch();
}

echo json_encode($rows);