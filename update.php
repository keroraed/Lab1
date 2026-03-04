<?php
require 'conn.php';

$id         = (int)($_POST['id'] ?? 0);
$first_name = trim($_POST['first_name'] ?? '');
$last_name  = trim($_POST['last_name']  ?? '');
$address    = trim($_POST['address']    ?? '');
$country    = $_POST['country']    ?? '';
$gender     = $_POST['gender']     ?? '';
$skills     = implode('-', $_POST['skills'] ?? []);
$username   = trim($_POST['username']   ?? '');
$password   = trim($_POST['password']   ?? '');
$department = trim($_POST['department'] ?? '');

$stmt = $connection->prepare(
    "UPDATE users SET first_name=?, last_name=?, address=?, country=?, gender=?, skills=?, username=?, password=?, department=? WHERE id=?"
);
$stmt->execute([$first_name, $last_name, $address, $country, $gender, $skills, $username, $password, $department, $id]);

header('Location: list.php');

