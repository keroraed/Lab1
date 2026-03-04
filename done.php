<?php
require 'conn.php';

$first_name = trim($_POST['first_name'] ?? '');
$last_name  = trim($_POST['last_name']  ?? '');
$address    = trim($_POST['address']    ?? '');
$country    = $_POST['country']    ?? '';
$gender     = $_POST['gender']     ?? '';
$skills     = $_POST['skills']     ?? [];
$skillsStr  = implode('-', $skills);
$username   = trim($_POST['username']   ?? '');
$password   = trim($_POST['password']   ?? '');
$department = trim($_POST['department'] ?? '');

$stmt = $connection->prepare(
    "INSERT INTO users (first_name, last_name, address, country, gender, skills, username, password, department)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->execute([$first_name, $last_name, $address, $country, $gender, $skillsStr, $username, $password, $department]);

$title    = ($gender === 'Male') ? 'Mr.' : 'Miss';
$fullName = $first_name . ' ' . $last_name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width:500px">
    <h3>Registration Successful</h3>
    <hr>
    <p>Thanks, <strong><?= htmlspecialchars($title . ' ' . $fullName) ?></strong>!</p>
    <table class="table table-bordered">
        <tr><th>Full Name</th><td><?= htmlspecialchars($fullName) ?></td></tr>
        <tr><th>Address</th><td><?= htmlspecialchars($address) ?></td></tr>
        <tr><th>Country</th><td><?= htmlspecialchars($country) ?></td></tr>
        <tr><th>Gender</th><td><?= htmlspecialchars($gender) ?></td></tr>
        <tr><th>Skills</th><td><?= htmlspecialchars($skillsStr ?: 'None') ?></td></tr>
        <tr><th>Username</th><td><?= htmlspecialchars($username) ?></td></tr>
        <tr><th>Department</th><td><?= htmlspecialchars($department) ?></td></tr>
    </table>
    <a href="list.php" class="btn btn-primary">Go to Users List</a>
    <a href="registeration.php" class="btn btn-secondary">Register Another</a>
</div>
</body>
</html>

$title = 'Miss';
if ($gender == 'Male') {
    $title = 'Mr.';
}

$fullName = $firstName . ' ' . $lastName;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
</head>
<body>
    <div>
        <p>Thanks <?php echo $title. ' ' . $fullName; ?></p>

        <p>Please Review Your Information:</p>

        <p><strong>Name:</strong> <?php echo $fullName; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>

        <p><strong>Your Skills:</strong></p>
        <?php
        if (!empty($skills)) {
            echo '<div>';
            foreach ($skills as $skill) {
                echo $skill . '<br>';
            }
            echo '</div>';
        } else {
            echo '<div>None</div>';
        }
        ?>

        <p><strong>Department:</strong> <?php echo $department; ?></p>
    </div>
    <br>
    <a href="list.php">Go to Users List</a>
</body>
</html>
