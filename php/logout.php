<?php
    session_start();
    
    if (isset($_SESSION['unique_id'])) { // If useris logged in then come to this page otherwise go to login page
        include_once 'config.php';

        $logoutId = mysqli_real_escape_string($connect, $_GET['logout_id']);

        if (isset($logoutId)) { // If logout id is set
            $status = 'Offline now';

            $sql = mysqli_query($connect, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logoutId}");

            if ($sql) {
                session_unset();
                session_destroy();
                header('location: ../login.php');
            }
        } else {
            header('location: ../users.php');
        }
    } else {
        header('location: ../login.php');
    }
?>