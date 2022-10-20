<?php
session_start();
require_once 'connect.php';


// Валидация пароля
function check_pass($pass) {
    if (strlen($pass) < 8) {
        $_SESSION['message'] = "Password less than 8 characters!";
        return false;
    }
    else if (strlen($pass) > 20) {
        $_SESSION['message'] = "Password more than 20 characters!";
        return false;
    }
    else if (!preg_match("#[0-9]+#", $pass)) {
        $_SESSION['message'] = "Password must include at least one number!";
        return false;
    }
    else if (!preg_match("#[a-zA-Z]+#", $pass)) {
        $_SESSION['message'] = "Password must include at least one letter!";
        return false;
    }
    return true;
}

// Валидация почты
function check_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Incorrect email!";
        return false;
    }
    return true;
}

 ?>
