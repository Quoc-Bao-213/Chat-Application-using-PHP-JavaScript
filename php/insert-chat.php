<?php
    session_start();

    if (isset($_SESSION['unique_id'])) {
        include_once 'config.php';
        $outGoingId = mysqli_real_escape_string($connect, $_POST['outgoing_id']);
        $inComingId = mysqli_real_escape_string($connect, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($connect, $_POST['message']);

        if (!empty($message)) {
            $sql = mysqli_query($connect, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ({$inComingId}, {$outGoingId}, '{$message}')") or die();
        }
    } else {
        header('../login.php');
    }
?>