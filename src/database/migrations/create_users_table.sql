CREATE TABLE IF NOT EXISTS users
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    email       VARCHAR(255) UNIQUE,
    telegram_id VARCHAR(255)
);