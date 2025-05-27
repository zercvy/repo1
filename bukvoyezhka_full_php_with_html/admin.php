<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin'])) die("Нет доступа");

$res = $conn->query("SELECT c.*, u.fio FROM cards c JOIN users u ON c.user_id = u.id ORDER BY c.id DESC");
?>
<!DOCTYPE html><html><head><meta charset='utf-8'><link rel='stylesheet' href='style.css'><title>Админ</title></head>
<body><div class='container'><h1>Админ-панель</h1>
<?php while($row = $res->fetch_assoc()): ?>
<div class='card'>
  <b><?= $row['title'] ?></b> — <?= $row['author'] ?> (<?= $row['fio'] ?>)<br>
  Статус: <?= $row['status'] ?><br>
  <form action='moderate.php' method='POST'>
    <input type='hidden' name='id' value='<?= $row['id'] ?>'>
    <select name='status'>
      <option value='Опубликована'>Опубликовать</option>
      <option value='Отклонена'>Отклонить</option>
    </select>
    <input name='reason' placeholder='Причина (если отклонено)'>
    <button>Сохранить</button>
  </form>
</div>
<?php endwhile; ?>
<a href='logout.php'>Выход</a></div></body></html>