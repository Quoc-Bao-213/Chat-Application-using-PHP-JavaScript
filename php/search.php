<?php
    session_start();
    include_once 'config.php';

    $outGoingId = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($connect, $_POST['searchTerm']);
    $output = "";
    $sql = mysqli_query($connect, "SELECT * FROM users WHERE NOT unique_id = {$outGoingId} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");

    if (mysqli_num_rows($sql) > 0) {
        include 'data.php';
    } else {
        $output .= "No user found related to your search term";
    }
    echo $output;
?>