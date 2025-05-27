<?php
require 'db.php';
session_start();
$user_id = $_SESSION['user_id'];

$course = $_POST['course'];
$start_date = DateTime::createFromFormat('d.m.Y', $_POST['start_date'])->format('Y-m-d');
$payment = $_POST['payment'];

$stmt = $conn->prepare("INSERT INTO applications (user_id, course_name, start_date, payment_method) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $course, $start_date, $payment);
$stmt->execute();

header("Location: dashboard.php");
?>