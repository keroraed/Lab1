<?php
require 'conn.php';
$id   = (int)($_GET['id'] ?? 0);
$stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$row  = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) { header('Location: list.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width:500px">
    <h3>User Details</h3>
    <hr>
    <table class="table table-bordered">
        <tr><th>ID</th><td><?= $row['id'] ?></td></tr>
        <tr><th>First Name</th><td><?= htmlspecialchars($row['first_name']) ?></td></tr>
        <tr><th>Last Name</th><td><?= htmlspecialchars($row['last_name']) ?></td></tr>
        <tr><th>Address</th><td><?= htmlspecialchars($row['address']) ?></td></tr>
        <tr><th>Country</th><td><?= htmlspecialchars($row['country']) ?></td></tr>
        <tr><th>Gender</th><td><?= htmlspecialchars($row['gender']) ?></td></tr>
        <tr><th>Skills</th><td><?= htmlspecialchars($row['skills']) ?></td></tr>
        <tr><th>Username</th><td><?= htmlspecialchars($row['username']) ?></td></tr>
        <tr><th>Password</th><td><?= htmlspecialchars($row['password']) ?></td></tr>
        <tr><th>Department</th><td><?= htmlspecialchars($row['department']) ?></td></tr>
        <?php if (!empty($row['image'])): ?>
        <tr>
            <th>Profile Picture</th>
            <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="Profile" style="max-width:150px; max-height:150px; border-radius:8px;"></td>
        </tr>
        <?php endif; ?>
    </table>
    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
    <a href="list.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
