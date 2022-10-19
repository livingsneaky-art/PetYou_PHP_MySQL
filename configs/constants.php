<?php

    session_start();

    define('SITEURL', 'http://localhost/PetYou_PHP_MySQL/');
    // define('SITEURL', 'http://localhost/petyou/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'petyous');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    