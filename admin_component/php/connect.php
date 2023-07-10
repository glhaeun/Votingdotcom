<?php
    $db_name = 'mysql:host=localhost:3306;dbname=imk2';
    $username = 'root';
    $password = '';
    $connect = new PDO($db_name, $username, $password);

    session_start();
?>
