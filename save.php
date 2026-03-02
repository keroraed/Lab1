<?php
$_POST['skills'] = implode("-", $_POST['skills'] ?? []);
unset($_POST['verification_input']);
unset($_POST['verification_code']);
$data = implode(",", $_POST);
file_put_contents("db.txt", $data . "\n", FILE_APPEND);
header("Location:list.php");
?>
