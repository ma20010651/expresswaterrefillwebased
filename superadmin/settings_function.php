<?php


function getSettingsData() {
    require 'reads.php'; // Include the necessary file for reading settings
    $settingsData = array();

    while ($row = mysqli_fetch_array($user_result)) {
        $settingsData[] = $row;
    }

    return $settingsData;
}
?>

