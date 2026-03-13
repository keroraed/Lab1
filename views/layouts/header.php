<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab1 App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=dashboard">Lab1 App</a>
        <?php if (Session::isLoggedIn()): ?>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white">Welcome, <strong><?= htmlspecialchars(Session::get('name')) ?></strong></span>
            <a href="index.php?page=users" class="btn btn-outline-light btn-sm">Users</a>
            <a href="index.php?page=users&action=create" class="btn btn-outline-light btn-sm">Add User</a>
            <a href="index.php?page=logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
