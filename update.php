<?php
$line = $_POST['line'];
unset($_POST['line']);
$_POST['skills'] = implode("-", $_POST['skills'] ?? []);
$data = implode(",", $_POST);

$result = file("db.txt", FILE_IGNORE_NEW_LINES);
$result[$line] = $data;
file_put_contents("db.txt", implode("\n", $result) . "\n");
header("Location:list.php");
?>
