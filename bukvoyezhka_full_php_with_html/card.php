<?php
require 'db.php';
session_start();
$user_id = $_SESSION['user_id'];

$author = $_POST['author'];
$title = $_POST['title'];
$type = $_POST['type'];
$publisher = $_POST['publisher'];
$year = $_POST['year'];
$cover = $_POST['cover'];
$condition = $_POST['condition'];

$stmt = $conn->prepare("INSERT INTO cards (user_id, author, title, type, publisher, year, cover_type, condition) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssss", $user_id, $author, $title, $type, $publisher, $year, $cover, $condition);
$stmt->execute();

header("Location: dashboard.php");
?>