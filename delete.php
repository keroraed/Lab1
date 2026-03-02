<?php
$line = $_GET['line'];
$result = file("db.txt", FILE_IGNORE_NEW_LINES);
unset($result[$line]);
file_put_contents("db.txt", implode("\n", $result) . "\n");
header("Location:list.php");
?>
