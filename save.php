<?php
require 'conn.php';

$first_name = trim($_POST['first_name'] ?? '');
$last_name  = trim($_POST['last_name']  ?? '');
$address    = trim($_POST['address']    ?? '');
$country    = $_POST['country']    ?? '';
$gender     = $_POST['gender']     ?? '';
$skills     = implode('-', $_POST['skills'] ?? []);
$username   = trim($_POST['username']   ?? '');
$password   = trim($_POST['password']   ?? '');
$department = trim($_POST['department'] ?? '');

// Handle profile picture upload
$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['image/jpeg', 'image/png'];
    if (in_array($_FILES['image']['type'], $allowed) && $_FILES['image']['size'] <= 2000000) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }
        $ext    = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $target = 'uploads/' . time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $imagePath = $target;
    }
}

$stmt = $connection->prepare(
    "INSERT INTO users (first_name, last_name, address, country, gender, skills, username, password, department, image)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->execute([$first_name, $last_name, $address, $country, $gender, $skills, $username, $password, $department, $imagePath]);

header('Location: list.php');
