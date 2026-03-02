<?php
$firstName = $_REQUEST['first_name'];
$lastName = $_REQUEST['last_name'];
$address = $_REQUEST['address'];
$country = $_REQUEST['country'] ?? '';
$gender = $_REQUEST['gender'] ?? '';
$skills = $_REQUEST['skills'] ?? [];
$username = $_REQUEST['username'] ?? '';
$password = $_REQUEST['password'] ?? '';
$department = $_REQUEST['department'] ?? '';

// Save to db.txt
$skillsStr = implode("-", $skills);
$data = implode(",", [$firstName, $lastName, $address, $country, $gender, $skillsStr, $username, $password, $department]);
file_put_contents("db.txt", $data . "\n", FILE_APPEND);

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
