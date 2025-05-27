<?php
require 'db.php';
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

if ($login === 'admin' && $password === 'bookworm') {
  $_SESSION['admin'] = true;
  header('Location: admin.php');
  exit;
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hash);
if ($stmt->num_rows > 0 && $stmt->fetch() && password_verify($password, $hash)) {
    $_SESSION['user_id'] = $id;
    header("Location: dashboard.php");
} else {
    echo "Неверный логин или пароль";
}
?>