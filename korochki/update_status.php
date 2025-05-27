<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    die("Нет доступа");
}
$id = $_POST['application_id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: admin.php");
?>