<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <?php
    $line = $_GET['line'];
    $result = file("db.txt", FILE_IGNORE_NEW_LINES);
    $row_data = explode(",", $result[$line]);
    $skills = explode("-", $row_data[5] ?? '');
    ?>
    <form action="update.php" method="post">
        <input type="hidden" name="line" value="<?php echo $line; ?>">

        <p>
            <label>First Name:</label><br>
            <input type="text" name="first_name" value="<?php echo $row_data[0] ?? ''; ?>" required>
        </p>

        <p>
            <label>Last Name:</label><br>
            <input type="text" name="last_name" value="<?php echo $row_data[1] ?? ''; ?>" required>
        </p>

        <p>
            <label>Address:</label><br>
            <textarea name="address" rows="4" cols="30" required><?php echo $row_data[2] ?? ''; ?></textarea>
        </p>

        <p>
            <label>Country:</label><br>
            <select name="country" required>
                <option value="">Select Country</option>
                <?php
                $countries = ["India", "USA", "UK", "Canada"];
                foreach ($countries as $c) {
                    $selected = (($row_data[3] ?? '') == $c) ? "selected" : "";
                    echo "<option value='$c' $selected>$c</option>";
                }
                ?>
            </select>
        </p>

        <p>
            Gender:<br>
            <label><input type="radio" name="gender" value="Male" <?php echo ($row_data[4] ?? '') == 'Male' ? 'checked' : ''; ?> required> Male</label>
            <label><input type="radio" name="gender" value="Female" <?php echo ($row_data[4] ?? '') == 'Female' ? 'checked' : ''; ?> required> Female</label>
        </p>

        <p>
            Skills:<br>
            <?php
            $allSkills = ["PHP", "MySQL", "J2SE", "PostgreSQL"];
            foreach ($allSkills as $s) {
                $checked = in_array($s, $skills) ? "checked" : "";
                echo "<label><input type='checkbox' name='skills[]' value='$s' $checked> $s</label> ";
            }
            ?>
        </p>

        <p>
            <label>Username:</label><br>
            <input type="text" name="username" value="<?php echo $row_data[6] ?? ''; ?>" required>
        </p>

        <p>
            <label>Password:</label><br>
            <input type="password" name="password" value="<?php echo $row_data[7] ?? ''; ?>" required>
        </p>

        <p>
            <label>Department:</label><br>
            <input type="text" name="department" value="<?php echo $row_data[8] ?? ''; ?>" required>
        </p>

        <p>
            <button type="submit">Update</button>
        </p>
    </form>
    <a href="list.php">Back to List</a>
</body>
</html>
