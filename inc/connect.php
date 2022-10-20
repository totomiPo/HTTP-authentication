<?php

    // Подключение к базе данных

    $connect = mysqli_connect('localhost', 'root', '', 'database');

    if (!$connect) {
        die('Error connect to DataBase');
    }
