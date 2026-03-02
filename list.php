<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h2>Users List</h2>
    <a href="home.php">Add New User</a>
    <br><br>
    <table border="1" cellpadding="5">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Country</th>
            <th>Gender</th>
            <th>Skills</th>
            <th>Username</th>
            <th>Password</th>
            <th>Department</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        if (file_exists("db.txt")) {
            $result = file("db.txt", FILE_IGNORE_NEW_LINES);
            foreach ($result as $index => $row) {
                if (empty(trim($row))) continue;
                $row_data = explode("|", $row);
                echo "<tr>";
                foreach ($row_data as $val) {
                    echo "<td>$val</td>";
                }
                echo "<td><a href='view.php?line=$index'>view</a></td>";
                echo "<td><a href='edit.php?line=$index'>edit</a></td>";
                echo "<td><a href='delete.php?line=$index'>delete</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
