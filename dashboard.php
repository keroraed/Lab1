<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <div class="card-body">
            <h5>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!</h5>
            <p class="text-muted">Logged in as: <?= htmlspecialchars($_SESSION['user']) ?></p>
            <div class="d-flex gap-2 mt-3">
                <a href="list.php" class="btn btn-info">View Users</a>
                <a href="home.php" class="btn btn-primary">Add New User</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
