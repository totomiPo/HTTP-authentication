<?php
session_start();
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

    <form action="inc/upd.php" method="post">
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <h1 > Update password </h1>
        <label>Login</label>
        <input type="text" name="login" placeholder="Enter the login">
        <label>Old password</label>
        <input type="password" name="password_old" placeholder="Enter the password">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter the password">
        <label>Confirm password</label>
        <input type="password" name="password_confirm" placeholder="Enter the password">
        <button type="submit" style="font-weight: bold">Update password</button>
        <a href="profile.php" style="text-align: center; margin-top: 10px">Cancel</a>
    </form>

</body>
</html>
