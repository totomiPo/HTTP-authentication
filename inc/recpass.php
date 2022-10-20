<?php

    session_start();
    require_once 'connect.php';
    require_once 'validdata.php';

    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $login = $_POST['login'];

    $login = mysqli_real_escape_string($connect,$_POST['login']);

    $sql = mysqli_query($connect,"SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");

    if ($password === $password_confirm) {
        if (mysqli_num_rows($sql) === 1){
            if (check_pass($password)){
                $new_password = password_hash($password, PASSWORD_BCRYPT);

                $update = mysqli_query($connect,"UPDATE `users` SET  `password` = '$new_password' WHERE `login` = '$login' LIMIT 1");
                if($update){
                    $_SESSION['message'] = 'Password changed successfully';
                    header('Location: ../index.php');
                } else {
                    $_SESSION['message'] = 'Error in data base';
                    header('Location: ../recovery.php');
                }
            } else {
                header('Location: ../recovery.php');
            }

        } else {
            $_SESSION['message'] = 'Invalid username';
            header('Location: ../index.php');
        }

    } else {
        $_SESSION['message'] = "Passwords don't match";
        header('Location: ../recovery.php');
    }
