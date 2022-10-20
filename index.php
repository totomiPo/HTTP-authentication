<?php
// буферизация вывода
ob_start();
session_start();
// доступ к странице
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

    <form action="inc/signin.php" method="post">
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <h1 > Entrance </h1>
        <label>Login</label>
        <input type="text" name="login" placeholder="Enter the login">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter the password">
        <p>
            Forgot your password? <a href="/recovery.php">Recover it</a>!
        </p>
        <button type="submit" style="font-weight: bold">Log in</button>
        <p>
             No account - <a href="/register.php">Sign up</a>!
        </p>
    </form>


    <script src="app\js\jquery-3.4.1.min.js"></script>
    <script src="app\js\main.js"></script>

</body>
</html>
