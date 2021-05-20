<?php
    session_start();
    include_once 'config.php';
    
    $outGoingId = $_SESSION['unique_id'];
    $sql = mysqli_query($connect, "SELECT * FROM users WHERE NOT unique_id = {$outGoingId}");
    $output = "";

    if (mysqli_num_rows($sql) == 0) {
        $output .= "No users are available to chat";
    } else if (mysqli_num_rows($sql) > 0) {
        include 'data.php';
    }
    echo $output;
?>