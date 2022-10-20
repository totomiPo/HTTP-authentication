<?php
    ob_start();
    session_start();
    require_once 'connect.php';
    require_once 'validdata.php';

    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $password_old = $_POST['password_old'];
    $login = $_POST['login'];

    $login = mysqli_real_escape_string($connect,$_POST['login']);

    $sql = mysqli_query($connect,"SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");


    if ($password === $password_confirm) {
        if (mysqli_num_rows($sql) === 1){
            if(check_pass($password)){
                $user = mysqli_fetch_assoc($sql);
                if(password_verify($password_old, $user['password'])) {

                    $new_password = password_hash($password, PASSWORD_BCRYPT);

                    $update = mysqli_query($connect,"UPDATE `users` SET  `password` = '$new_password' WHERE `login` = '$login' LIMIT 1");
                    if($update){
                        $_SESSION['message'] = 'Password changed successfully';
                        header('Location: ../profile.php');
                    } else {
                        $_SESSION['message'] = 'Error in data base';
                        header('Location: ../update.php');
                    }

                } else {
                    $_SESSION['message'] = 'Invalid old password';
                    header('Location: ../update.php');
                }

            } else {
                header('Location: ../update.php');
            }

        } else {
            $_SESSION['message'] = 'Invalid username';
            header('Location: ../update.php');
        }

    } else {
        $_SESSION['message'] = "Passwords don't match";
        header('Location: ../update.php');
    }
