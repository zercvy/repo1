<?php
require 'db.php';
session_start();
$user_id = $_SESSION['user_id'];
$application_id = $_POST['application_id'];
$feedback = $_POST['feedback'];

$stmt = $conn->prepare("UPDATE applications SET feedback = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("sii", $feedback, $application_id, $user_id);
$stmt->execute();

header("Location: dashboard.php");
?>