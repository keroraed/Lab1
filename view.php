<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
</head>
<body>
    <h2>User Details</h2>
    <?php
    $line = $_GET['line'];
    $result = file("db.txt", FILE_IGNORE_NEW_LINES);
    $row_data = explode(",", $result[$line]);
    $fields = ["First Name", "Last Name", "Address", "Country", "Gender", "Skills", "Username", "Password", "Department"];
    ?>
    <table border="1" cellpadding="5">
        <?php
        foreach ($fields as $i => $field) {
            echo "<tr>";
            echo "<th>$field</th>";
            echo "<td>" . ($row_data[$i] ?? '') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="list.php">Back to List</a>
</body>
</html>
