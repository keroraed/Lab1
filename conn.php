<?php
$dsn  = "mysql:host=localhost;dbname=lab1;charset=utf8mb4";
$user = "root";
$pass = "";

try {
    $connection = new PDO($dsn, $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
