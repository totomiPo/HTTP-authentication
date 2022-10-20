<?php
    ob_start();
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }
?>

<!doctype html>
<html>
<head>
    <title>First lab</title>
    <meta charset="UTF-8">
    <meta name="author" content="Daria Dubrovina">
    <link rel="shortcut icon" href="app/label.ico" type="image/x-icon">
    <link rel="stylesheet" href="app/css/main.css">
</head>
<body>

    <form action="inc/signup.php" method="post">
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <h1> Registration </h1>
        <label>Login</label>
        <input type="text" name="login" placeholder="Enter the login">
        <label>Email</label>
        <input type="text" name="email" placeholder="Enter the email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter the password">
        <label>Confirm password</label>
        <input type="password" name="password_confirm" placeholder="Enter the password">
        <button type="submit" style="font-weight: bold">Log in</button>
        <p>
            Have account - <a href="/">Log in</a>!
        </p>
    </form>

</body>
</html>
