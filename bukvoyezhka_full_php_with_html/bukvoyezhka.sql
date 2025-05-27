
CREATE DATABASE IF NOT EXISTS bukvoyezhka;
USE bukvoyezhka;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fio VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL,
  login VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE cards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  author VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  type ENUM('Готов поделиться', 'Хочу в свою библиотеку') NOT NULL,
  publisher VARCHAR(255),
  year VARCHAR(10),
  cover_type VARCHAR(50),
  condition TEXT,
  status ENUM('Новая', 'Опубликована', 'Отклонена') DEFAULT 'Новая',
  rejection_reason TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
