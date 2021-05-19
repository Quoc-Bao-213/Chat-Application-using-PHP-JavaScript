<?php
    session_start();
    include_once 'config.php';

    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Check users entered email & password matched to database any table row email and password
        $sql = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");

        if (mysqli_num_rows($sql) > 0) { // If users credentials matched
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "Success";
        } else {
            echo "Email or Password is incorrect!";
        }
    } else {
        echo "All input fields are required!";
    }
?>