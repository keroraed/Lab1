<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width:600px">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New User</h5>
        </div>
        <div class="card-body">
            <form action="save.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="address" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <select class="form-select" name="country" required>
                        <option value="">Select Country</option>
                        <option value="India">India</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                        <option value="Canada">Canada</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="Male" required>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="Female">
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Skills</label><br>
                    <?php foreach (["PHP","MySQL","J2SE","PostgreSQL"] as $s): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="<?= $s ?>">
                        <label class="form-check-label"><?= $s ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <input type="text" class="form-control" name="department" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/png">
                    <small class="text-muted">Optional. JPG or PNG only, max 2MB.</small>
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