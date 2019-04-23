<?php
function createMySQLConnection() {
    $connection = mysqli_connect('localhost', 'username', 'password', 'db_name', '3306');
    mysqli_autocommit($connection, false);
    return $connection;
}
