<?php
    $connect = mysqli_connect('localhost', 'root', '', 'chat');
    if (!$connect) {
        echo "Database Connected" . mysqli_connect_error();
    }
?>