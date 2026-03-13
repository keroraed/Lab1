<?php
require 'conn.php';

$errors = [];
$form = [
    'first_name' => '',
    'last_name'  => '',
    'address'    => '',
    'country'    => '',
    'gender'     => '',
    'skills'     => [],
    'username'   => '',
    'password'   => '',
    'department' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['first_name'] = trim($_POST['first_name'] ?? '');
    $form['last_name']  = trim($_POST['last_name']  ?? '');
    $form['address']    = trim($_POST['address']    ?? '');
    $form['country']    = $_POST['country']    ?? '';
    $form['gender']     = $_POST['gender']     ?? '';
    $form['skills']     = $_POST['skills']     ?? [];
    $form['username']   = trim($_POST['username']   ?? '');
    $form['password']   = trim($_POST['password']   ?? '');
    $form['department'] = trim($_POST['department'] ?? '');

    // Server-side validation
    if (empty($form['first_name']) || !preg_match("/^[a-zA-Z]+$/", $form['first_name']))
        $errors['first_name'] = "First name must contain letters only";

    if (empty($form['last_name']) || !preg_match("/^[a-zA-Z]+$/", $form['last_name']))
        $errors['last_name'] = "Last name must contain letters only";

    if (empty($form['address']))
        $errors['address'] = "Address is required";

    if (empty($form['country']))
        $errors['country'] = "Country is required";

    if (empty($form['gender']))
        $errors['gender'] = "Gender is required";

    if (empty($form['skills']))
        $errors['skills'] = "Select at least one skill";

    if (empty($form['username']))
        $errors['username'] = "Username is required";

    if (!preg_match("/^[a-z0-9_]{8}$/", $form['password']))
        $errors['password'] = "Password must be exactly 8 characters (lowercase letters, digits, underscore only)";

    if (empty($form['department']))
        $errors['department'] = "Department is required";

    if (empty($errors)) {
        $skillsStr = implode('-', $form['skills']);
        $stmt = $connection->prepare(
            "INSERT INTO users (first_name, last_name, address, country, gender, skills, username, password, department)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $form['first_name'], $form['last_name'], $form['address'],
            $form['country'], $form['gender'], $skillsStr,
            $form['username'], $form['password'], $form['department'],
        ]);
        header('Location: list.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function validateForm() {
        const fname    = document.forms["userForm"]["first_name"].value.trim();
        const lname    = document.forms["userForm"]["last_name"].value.trim();
        const address  = document.forms["userForm"]["address"].value.trim();
        const country  = document.forms["userForm"]["country"].value;
        const password = document.forms["userForm"]["password"].value;
        const username = document.forms["userForm"]["username"].value.trim();
        const dept     = document.forms["userForm"]["department"].value.trim();

        const nameRegex = /^[a-zA-Z]+$/;
        const passRegex = /^[a-z0-9_]{8}$/;

        const genderRadios = document.querySelectorAll('input[name="gender"]');
        let genderChecked = false;
        genderRadios.forEach(r => { if (r.checked) genderChecked = true; });

        const skillBoxes = document.querySelectorAll('input[name="skills[]"]');
        let skillChecked = false;
        skillBoxes.forEach(b => { if (b.checked) skillChecked = true; });

        if (!nameRegex.test(fname)) {
            alert("First name must contain letters only");
            return false;
        }
        if (!nameRegex.test(lname)) {
            alert("Last name must contain letters only");
            return false;
        }
        if (address === "") {
            alert("Address is required");
            return false;
        }
        if (country === "") {
            alert("Please select a country");
            return false;
        }
        if (!genderChecked) {
            alert("Please select a gender");
            return false;
        }
        if (!skillChecked) {
            alert("Please select at least one skill");
            return false;
        }
        if (username === "") {
            alert("Username is required");
            return false;
        }
        if (!passRegex.test(password)) {
            alert("Password must be exactly 8 characters (lowercase letters, digits, underscore only)");
            return false;
        }
        if (dept === "") {
            alert("Department is required");
            return false;
        }
        return true;
    }
    </script>
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width:600px">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New User</h5>
        </div>
        <div class="card-body">
            <form action="home.php" method="post" name="userForm" onsubmit="return validateForm()">

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name</label>
                        <input type="text"
                               class="form-control <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>"
                               name="first_name" value="<?= htmlspecialchars($form['first_name']) ?>">
                        <div class="invalid-feedback"><?= $errors['first_name'] ?? '' ?></div>
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name</label>
                        <input type="text"
                               class="form-control <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>"
                               name="last_name" value="<?= htmlspecialchars($form['last_name']) ?>">
                        <div class="invalid-feedback"><?= $errors['last_name'] ?? '' ?></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                              name="address" rows="3"><?= htmlspecialchars($form['address']) ?></textarea>
                    <div class="invalid-feedback"><?= $errors['address'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <select class="form-select <?= isset($errors['country']) ? 'is-invalid' : '' ?>" name="country">
                        <option value="">Select Country</option>
                        <?php foreach (['Egypt', 'India', 'USA', 'UK', 'Canada'] as $c): ?>
                        <option value="<?= $c ?>" <?= $form['country'] === $c ? 'selected' : '' ?>><?= $c ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= $errors['country'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <?php foreach (['Male', 'Female'] as $g): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender"
                               value="<?= $g ?>" <?= $form['gender'] === $g ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $g ?></label>
                    </div>
                    <?php endforeach; ?>
                    <?php if (isset($errors['gender'])): ?>
                    <div class="text-danger small mt-1"><?= $errors['gender'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skills</label><br>
                    <?php foreach (['PHP', 'MySQL', 'J2SE', 'PostgreSQL'] as $s): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="skills[]"
                               value="<?= $s ?>" <?= in_array($s, $form['skills']) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $s ?></label>
                    </div>
                    <?php endforeach; ?>
                    <?php if (isset($errors['skills'])): ?>
                    <div class="text-danger small mt-1"><?= $errors['skills'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                           name="username" value="<?= htmlspecialchars($form['username']) ?>">
                    <div class="invalid-feedback"><?= $errors['username'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                           name="password">
                    <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
                    <small class="text-muted">8 characters: lowercase letters, digits, underscore only</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <input type="text"
                           class="form-control <?= isset($errors['department']) ? 'is-invalid' : '' ?>"
                           name="department" value="<?= htmlspecialchars($form['department']) ?>">
                    <div class="invalid-feedback"><?= $errors['department'] ?? '' ?></div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save User</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="list.php" class="btn btn-outline-secondary">Back to List</a>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>
