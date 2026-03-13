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
$new_pass   = trim($_POST['password']   ?? '');
$department = trim($_POST['department'] ?? '');

if ($new_pass !== '') {
    // New password provided — hash and update it
    $stmt = $connection->prepare(
        "UPDATE users SET first_name=?, last_name=?, address=?, country=?, gender=?, skills=?, username=?, password=?, department=? WHERE id=?"
    );
    $stmt->execute([
        $first_name, $last_name, $address, $country, $gender, $skills,
        $username, password_hash($new_pass, PASSWORD_DEFAULT), $department, $id,
    ]);
} else {
    // No new password — keep existing hash
    $stmt = $connection->prepare(
        "UPDATE users SET first_name=?, last_name=?, address=?, country=?, gender=?, skills=?, username=?, department=? WHERE id=?"
    );
    $stmt->execute([
        $first_name, $last_name, $address, $country, $gender, $skills,
        $username, $department, $id,
    ]);
}

header('Location: list.php');
