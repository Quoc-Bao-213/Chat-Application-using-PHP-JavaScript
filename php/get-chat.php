<?php
    session_start();

    if (isset($_SESSION['unique_id'])) {
        include_once 'config.php';
        $outGoingId = mysqli_real_escape_string($connect, $_POST['outgoing_id']);
        $inComingId = mysqli_real_escape_string($connect, $_POST['incoming_id']);
        $output = '';
        $sql = "SELECT * FROM messages
                LEFT JOIN users on users.unique_id = messages.incoming_msg_id
                WHERE (outgoing_msg_id = {$outGoingId} AND incoming_msg_id = {$inComingId}) 
                OR (outgoing_msg_id = {$inComingId} AND incoming_msg_id = {$outGoingId}) 
                ORDER BY msg_id";
        $query = mysqli_query($connect, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['outgoing_msg_id'] === $outGoingId) { // If this is equal to then user is a msg sender
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
                } else { // User is a msg receiver
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/' . $row['img'] . '" alt="">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
                }
            }
            
            echo $output;
        }
    } else {
        header('../login.php');
    }
