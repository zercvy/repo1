<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    die("Нет доступа");
}
$result = $conn->query("SELECT a.*, u.fio FROM applications a JOIN users u ON a.user_id = u.id ORDER BY a.id DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Админ-панель</title></head>
<body><div class="container"><header class="header"><div class="header-inner"><div class="logo">Корочки.есть</div><a href="logout.php" class="logout">Выйти</a></div></header><h1>Админ-панель</h1>
<?php while($row = $result->fetch_assoc()): ?>
  <div class="card">
    <p><strong>Пользователь:</strong> <?= $row['fio'] ?></p>
    <p><strong>Курс:</strong> <?= $row['course_name'] ?></p>
    <p><strong>Дата:</strong> <?= date('d.m.Y', strtotime($row['start_date'])) ?></p>
    <p><strong>Оплата:</strong> <?= $row['payment_method'] ?></p>
    <p><strong>Статус:</strong> <?= $row['status'] ?></p>
    <form action="update_status.php" method="POST">
      <input type="hidden" name="application_id" value="<?= $row['id'] ?>" />
      <select name="status" required>
        <option value="">-- Изменить статус --</option>
        <option value="Идет обучение">Идет обучение</option>
        <option value="Обучение завершено">Обучение завершено</option>
      </select>
      <button type="submit">Обновить</button>
    </form>
  </div>
<?php endwhile; ?>
</div></body></html>