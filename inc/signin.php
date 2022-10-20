<?php
    ob_start();
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($check_user) === 1) {

        $user = mysqli_fetch_assoc($check_user);

        if(password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "email" => $user['email'],
                "login" => $user['login']
            ];
            header('Location: ../profile.php');
        } else {
            $_SESSION['message'] = 'Invalid password';
            header('Location: ../index.php');
        }
    } else {
        $_SESSION['message'] = 'Invalid username';
        header('Location: ../index.php');
    }
    ?>
