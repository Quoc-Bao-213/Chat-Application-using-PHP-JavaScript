<?php
    session_start();
    include_once 'config.php';

    $firstName = mysqli_real_escape_string($connect, $_POST['fname']);
    $lastName = mysqli_real_escape_string($connect, $_POST['lname']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (!empty($firstName) && !empty($lastName) &&! empty($email) &&! empty($password)) {
        // Check user email is valid or not
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // If email is valid
            // Check that email already exist in the database or nor
            $sql = mysqli_query($connect, "SELECT email FROM users WHERE email = '{$email}'");

            if (mysqli_num_rows($sql) > 0) { // If email already exist
                echo "$email - This email already exist!";
            } else {
                // Check user upload file or not
                if (isset($_FILES['image'])) { // If file is uploaded
                    $imgName = $_FILES['image']['name']; // Getting user uploaded image name
                    $imgType = $_FILES['image']['type']; // Getting user uploaded image type
                    $tmpName = $_FILES['image']['tmp_name']; // This temporary name is used to save/move file in our folder

                    // Explode image and get the last extension like jpg, png
                    $imgExplode = explode('.', $imgName);
                    $imgExt = end($imgExplode); // Get ext of an user uploaded img file

                    $extensions = ['png', 'jpeg', 'jpg']; // These are some valid ext

                    if (in_array($imgExt, $extensions) === true) { // If user uploaded img ext is matched with any array extensions
                        $time = time(); // Get current time
                        $newImageName = $time . $imgName; // Move the user uploaded img to our particular folder

                        if (move_uploaded_file($tmpName, 'images/' . $newImageName)) { // If user upload img move to our folder successfully
                            $status = "Active now"; // User signed up then status will be active now 
                            $random_id = rand($time, 10000000); // Createing random id for user

                            // Insert all user data inside table
                            $sql2 = mysqli_query($connect, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUE ({$random_id}, '{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$newImageName}', '{$status}')");

                            if ($sql2) { // If these data inserted
                                $sql3 = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}'");

                                if (mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; 
                                    echo "Success";
                                }
                            } else {
                                echo "Something went wrong!";
                            }
                        }
                    } else {
                        echo "Please select an Image file - jpeg, jpg, png!";
                    }
                } else {
                    echo "Please select an Image file!";
                }
            }
        } else {
            echo "$email - This is not a valid email";
        }
    } else {
        echo "All input field are required!";
    }
?>