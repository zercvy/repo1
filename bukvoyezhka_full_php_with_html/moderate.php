<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin'])) die("Нет доступа");

$id = $_POST['id'];
$status = $_POST['status'];
$reason = $_POST['reason'];

$stmt = $conn->prepare("UPDATE cards SET status = ?, rejection_reason = ? WHERE id = ?");
$stmt->bind_param("ssi", $status, $reason, $id);
$stmt->execute();

header("Location: admin.php");
?>