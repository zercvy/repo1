<?php
require 'db.php';
session_start();
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM applications WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><link rel="stylesheet" href="style.css"><title>Мои заявки</title></head>
<body><div class="container"><header class="header"><div class="header-inner"><div class="logo">Корочки.есть</div><a href="logout.php" class="logout">Выход</a></div></header><h1>Мои заявки</h1>
<?php while($row = $result->fetch_assoc()): ?>
  <div class="card">
    <p><strong>Курс:</strong> <?= $row['course_name'] ?></p>
    <p><strong>Дата:</strong> <?= date('d.m.Y', strtotime($row['start_date'])) ?></p>
    <p><strong>Оплата:</strong> <?= $row['payment_method'] ?></p>
    <p><strong>Статус:</strong> <?= $row['status'] ?></p>
    <?php if ($row['status'] === 'Обучение завершено' && !$row['feedback']): ?>
      <form action="feedback.php" method="POST">
        <input type="hidden" name="application_id" value="<?= $row['id'] ?>" />
        <textarea name="feedback" placeholder="Оставьте отзыв..." required></textarea>
        <button type="submit">Отправить отзыв</button>
      </form>
    <?php elseif ($row['feedback']): ?>
      <p><strong>Отзыв:</strong> <?= htmlspecialchars($row['feedback']) ?></p>
    <?php endif; ?>
  </div>
<?php endwhile; ?>
</div></body></html>