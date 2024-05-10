<?php

include 'model.php';

$order = new Order();

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $useradmin_id = $_SESSION['useradmin_id'];

    $rows = $order->date_range($start_date, $end_date,  $useradmin_id);
} else {
    $rows = $order->fetch();
}

echo json_encode($rows);