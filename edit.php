<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
require 'conn.php';
$id   = (int)($_GET['id'] ?? 0);
$stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$row  = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) { header('Location: list.php'); exit; }
$skills = explode('-', $row['skills']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width:600px">
    <h3>Edit User #<?= $row['id'] ?></h3>
    <hr>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <p>
            <label>First Name:</label><br>
            <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required>
        </p>
        <p>
            <label>Last Name:</label><br>
            <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required>
        </p>
        <p>
            <label>Address:</label><br>
            <textarea name="address" rows="3" cols="35"><?= htmlspecialchars($row['address']) ?></textarea>
        </p>
        <p>
            <label>Country:</label><br>
            <select name="country" required>
                <option value="">Select Country</option>
                <?php foreach (['India','USA','UK','Canada'] as $c): ?>
                <option value="<?= $c ?>" <?= $row['country'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            Gender:<br>
            <label><input type="radio" name="gender" value="Male" <?= $row['gender'] === 'Male' ? 'checked' : '' ?> required> Male</label>
            <label><input type="radio" name="gender" value="Female" <?= $row['gender'] === 'Female' ? 'checked' : '' ?>> Female</label>
        </p>
        <p>
            Skills:<br>
            <?php foreach (['PHP','MySQL','J2SE','PostgreSQL'] as $s): ?>
            <label><input type="checkbox" name="skills[]" value="<?= $s ?>" <?= in_array($s, $skills) ? 'checked' : '' ?>> <?= $s ?></label>
            <?php endforeach; ?>
        </p>
        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="password" value="<?= htmlspecialchars($row['password']) ?>" required>
        </p>
        <p>
            <label>Department:</label><br>
            <input type="text" name="department" value="<?= htmlspecialchars($row['department']) ?>" required>
        </p>
        <p>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </p>
    </form>
</div>
</body>
</html>
