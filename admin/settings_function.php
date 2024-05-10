<?php

function getUserSettings($id, $con)
{

    if (session_status() == PHP_SESSION_NONE) {

    session_start();
}

    $query = "SELECT * FROM useradmin WHERE useradmin_id = ?";
    $stmt = $con->prepare($query);

    if ($stmt === false) {
        die('Error in prepare statement: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}

?>