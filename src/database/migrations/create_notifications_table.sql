CREATE TABLE IF NOT EXISTS notifications
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT,
    period_minutes INT,
    text           TEXT,
    last_sent_at   TIMESTAMP NULL DEFAULT NULL
);