<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
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

    <form>
        <h2 style="margin: 10px 0;"> Hello, <?= $_SESSION['user']['login'] ?>!</h2>
        <a href="#"><?= $_SESSION['user']['email'] ?></a>
        <a href="update.php">Update password</a>
        <a href="inc/logout.php" class="logout">Log out</a>
    </form>

</body>
</html>
