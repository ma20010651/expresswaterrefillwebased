<?php
require '../connection.php';

if (!isset($_SESSION['useradmin_id'])) {
    
    exit();
}

if (isset($_POST['usersearch'])) {
    $uservaluesearch = $_POST['uservaluesearch'];
    $useradmin_id = $_SESSION['useradmin_id'];

    $user_query = $con->prepare("SELECT * FROM `products` WHERE `useradmin_id` = ? AND CONCAT(`type`) LIKE ?");
    $user_query->bind_param("is", $useradmin_id, '%' . $uservaluesearch . '%');
    $user_query->execute();
    
    $user_result = $user_query->get_result();
} else {
    $useradmin_id = $_SESSION['useradmin_id'];

    $user_query = $con->prepare("SELECT * FROM `products` WHERE `useradmin_id` = ?");
    $user_query->bind_param("i", $useradmin_id);
    $user_query->execute();
    
    $user_result = $user_query->get_result();
}

if ($user_result) {

    while ($row = $user_result->fetch_assoc()) {
        
          echo '<tr>';
        echo '<td><img src="../upload/' . $row['image'] . '" style="width: 90px; height: auto;" class="zoom"></td>';
        echo '<td>' . $row['type'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '<td>';
        echo '<div class="dropdown">';
        echo '<div class="dropbtn">Action</div>';
        echo '<div class="dropdown-content">';
        echo '<a style="padding-right: 78px" href="editproducts.php?product_id=' . $row['product_id'] . '"><img src="../images/update.png" height="25px" width="22px"> Edit </a>';
        echo '<form action="archive.php" method="GET">';
        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
        echo '<button style="padding-right: 65px" class="btn btn-infos" onclick="return confirm(\'Are you sure you want to move to trash?\')"><img src="../images/delete.jpg" height="22px" width="22px"> Trash </button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
} else {
   
    echo 'Error in query: ' . $con->error;
}

$user_query->close();
?>
