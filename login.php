<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

require 'conn.php';

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user']     = $user['username'];
        $_SESSION['name']     = $user['first_name'];
        $_SESSION['user_id']  = $user['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width:400px">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Login</h4>
        </div>
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control" name="username" placeholder="Username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="d-flex gap-2">
                    <button class="btn btn-success" name="login">Login</button>
                    <a href="home.php" class="btn btn-secondary">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
