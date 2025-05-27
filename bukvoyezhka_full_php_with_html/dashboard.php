<?php
require 'db.php';
session_start();
$user_id = $_SESSION['user_id'];
$res = $conn->query("SELECT * FROM cards WHERE user_id = $user_id ORDER BY id DESC");
?>
<!DOCTYPE html><html><head><meta charset='utf-8'><link rel='stylesheet' href='style.css'><title>Карточки</title></head>
<body><div class='container'><h1>Мои карточки</h1>
<?php while($row = $res->fetch_assoc()): ?>
<div class='card'>
  <strong><?= $row['title'] ?></strong> — <?= $row['author'] ?><br>
  Тип: <?= $row['type'] ?><br>
  Статус: <?= $row['status'] ?><br>
  <?php if ($row['status'] === 'Отклонена') echo 'Причина: ' . $row['rejection_reason']; ?>
</div>
<?php endwhile; ?>
<a href='logout.php'>Выход</a></div></body></html>