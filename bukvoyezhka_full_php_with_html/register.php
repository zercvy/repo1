<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Доступ запрещён');

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$fio = $_POST['fio'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) die("Логин уже занят");

$stmt = $conn->prepare("INSERT INTO users (fio, phone, email, login, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fio, $phone, $email, $login, $hash);
$stmt->execute();

header("Location: login.html");
?>