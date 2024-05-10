<?php

function getUserSetting($user_id, $con)
{
    // Check if the connection is still open
    if (session_status() == PHP_SESSION_NONE) {
    // Only start the session if it's not already started
    session_start();
}

    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $con->prepare($query);

    if ($stmt === false) {
        die('Error in prepare statement: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}

?>