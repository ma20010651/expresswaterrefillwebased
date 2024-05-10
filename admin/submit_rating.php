<?php

$connect = new PDO("mysql:host=localhost;dbname=u139123658_waterstation", "u139123658_waterstation", "Qoobeeagapi04");


if (isset($_POST["rating_data"])) {
    $user_id = $_POST["user_id"];
    $useradmin_id = $_POST["useradmin_id"];
    $user_name = $_POST["user_name"];
    $rating_data = $_POST["rating_data"];
    $user_review = $_POST["user_review"];
    
    $image_file = $_FILES["user_image"];
    $image_name = $image_file["name"];
    $image_tmp = $image_file["tmp_name"];
    $image_destination = "../review/" . $image_name;
    move_uploaded_file($image_tmp, $image_destination);


    $query = "SELECT COUNT(*) FROM review_table WHERE user_id = :user_id";
    $statement = $connect->prepare($query);
    $statement->execute(array(':user_id' => $user_id));
    $count = $statement->fetchColumn();

    if ($count > 0) {
        echo "You have already submitted a review";
        exit();
    } else {

        $query = "INSERT INTO review_table (user_id, useradmin_id, user_name, user_rating, user_review, user_image, datetime) 
                  VALUES (:user_id, :useradmin_id, :user_name, :user_rating, :user_review, :user_image, CURRENT_TIMESTAMP())";
        $statement = $connect->prepare($query);
        $statement->execute(array(
            ':user_id' => $user_id,
            ':useradmin_id' => $useradmin_id,
            ':user_name' => $user_name,
            ':user_rating' => $rating_data,
            ':user_review' => $user_review,
            ':user_image' => $image_destination
        ));

        echo "Your Review & Rating Successfully Submitted";
    }
}

if (isset($_POST["action"]) && $_POST["action"] === 'load_data') {
    
    $useradmin_id = $_POST["useradmin_id"];
    
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "
    SELECT * FROM review_table 
    WHERE useradmin_id = :useradmin_id
    ORDER BY review_id DESC
    ";
    $statement = $connect->prepare($query);
    $statement->execute(array(':useradmin_id' => $useradmin_id));

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $datetime = date('Y-m-d H:i:s', strtotime($row["datetime"]));
        $image_path = $row["user_image"];

        switch ($row["user_rating"]) {
            case 5:
                $five_star_review++;
                break;
            case 4:
                $four_star_review++;
                break;
            case 3:
                $three_star_review++;
                break;
            case 2:
                $two_star_review++;
                break;
            case 1:
                $one_star_review++;
                break;
        }

        $total_user_rating += $row["user_rating"];
        $total_review++;

        $review_content[] = array(
            'user_name' => $row["user_name"],
            'user_review' => $row["user_review"],
            'rating' => $row["user_rating"],
            'datetime' => $datetime,
            'user_image' => $image_path
        );
    }

    if ($total_review > 0) {
        $average_rating = $total_user_rating / $total_review;
    }

    $output = array(
        'average_rating' => number_format($average_rating, 1),
        'total_review' => $total_review,
        'five_star_review' => $five_star_review,
        'four_star_review' => $four_star_review,
        'three_star_review' => $three_star_review,
        'two_star_review' => $two_star_review,
        'one_star_review' => $one_star_review,
        'review_data' => $review_content
    );

    echo json_encode($output);
}
?>
