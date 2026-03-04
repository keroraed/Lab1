<?php
require 'conn.php';

$id   = (int)($_GET['id'] ?? 0);
$stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header('Location: list.php');

