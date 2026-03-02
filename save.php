<?php
$_POST = array_map(fn($v) => is_array($v) ? $v : str_replace(["\r", "\n"], " ", $v), $_POST);
$_POST['skills'] = implode("-", $_POST['skills'] ?? []);
unset($_POST['verification_input']);
unset($_POST['verification_code']);
$data = implode("|", $_POST);
file_put_contents("db.txt", $data . "\n", FILE_APPEND);
header("Location:list.php");
?>
