<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width:600px">
    <h3>Registration Form</h3>
    <hr>
    <form action="done.php" method="post">
        <p><label>First Name:</label><br><input type="text" name="first_name" required></p>
        <p><label>Last Name:</label><br><input type="text" name="last_name" required></p>
        <p><label>Address:</label><br><textarea name="address" rows="3" cols="35"></textarea></p>
        <p><label>Country:</label><br><select name="country" required><option value="">Select Country</option><option value="India">India</option><option value="USA">USA</option><option value="UK">UK</option><option value="Canada">Canada</option></select></p>
        <p>Gender:<br><label><input type="radio" name="gender" value="Male" required> Male</label> <label><input type="radio" name="gender" value="Female"> Female</label></p>
        <p>Skills:<br><?php foreach (['PHP','MySQL','J2SE','PostgreSQL'] as $s): ?><label><input type="checkbox" name="skills[]" value="<?= $s ?>"> <?= $s ?></label> <?php endforeach; ?></p>
        <p><label>Username:</label><br><input type="text" name="username" required></p>
        <p><label>Password:</label><br><input type="password" name="password" required></p>
        <p><label>Department:</label><br><input type="text" name="department" required></p>
        <p><button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button> <a href="list.php" class="btn btn-outline-secondary">Back to List</a></p>
    </form>
</div>
</body>
</html>
