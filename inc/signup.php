<?php
    ob_start();
    session_start();
    require_once 'connect.php';
    require_once 'validdata.php';


    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($check_user) === 0) {

        if ($password === $password_confirm) {

            if (!empty($login) || !empty($email) || !empty($password) || !empty($password_confirm)) {

                if (check_pass($password)){

                    if (check_email($email)){

                        $password_h = password_hash($password, PASSWORD_BCRYPT);
                        mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES (NULL, '$login', '$email', '$password_h')");
                        header('Location: ../profile.php');

                    } else {
                        header('Location: ../register.php');
                    }

                } else {
                    header('Location: ../register.php');
                }

            } else {
                $_SESSION['message'] = "Empty field, repeat enter";
                header('Location: ../register.php');
            }

        } else {
            $_SESSION['message'] = "Passwords don't match";
            header('Location: ../register.php');
        }
    } else {
        $_SESSION['message'] = "Username already exists";
        header('Location: ../register.php');
    }

?>
