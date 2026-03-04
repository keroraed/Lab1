<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:600px">
    <h3 class="mb-4">Database Setup</h3>
    <?php
    $conn = new mysqli('localhost', 'root', '');
    if ($conn->connect_error) {
        echo '<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>';
        exit;
    }

    // Create database
    if ($conn->query("CREATE DATABASE IF NOT EXISTS lab1")) {
        echo '<div class="alert alert-success">✔ Database <strong>lab1</strong> is ready.</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating database: ' . $conn->error . '</div>';
    }

    $conn->select_db('lab1');

    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id          INT AUTO_INCREMENT PRIMARY KEY,
        first_name  VARCHAR(100) NOT NULL,
        last_name   VARCHAR(100) NOT NULL,
        address     TEXT,
        country     VARCHAR(100),
        gender      VARCHAR(10),
        skills      VARCHAR(255),
        username    VARCHAR(100),
        password    VARCHAR(255),
        department  VARCHAR(100)
    )";

    if ($conn->query($sql)) {
        echo '<div class="alert alert-success">✔ Table <strong>users</strong> is ready.</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating table: ' . $conn->error . '</div>';
    }

    $conn->close();
    ?>
    <a href="list.php" class="btn btn-primary">Go to Users List</a>
</div>
</body>
</html>
