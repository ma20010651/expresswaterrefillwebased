<?php

    require "functions.php";
    check_login();

    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $message = $_POST['message'];

    $email_from = 'Water RefellingStation';

    $email_subject = "New Form Submission";

    $email_body = "User Name: $name \n". "User Email: $visitor_email \n". "User Message: $message \n";

    $to = "wrsteamtalongist@gmail.com";

    $headers = "From: $email_from \r\n";

    $headers = "RepZly-To: $visitor_email \r\n";

    mail($to, $email_subject, $email_body, $headers);

    header("Location: myprofile.php");
?>