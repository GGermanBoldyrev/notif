CREATE TABLE notifications
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT,
    period_minutes INT,
    text           TEXT,
    last_sent_at   TIMESTAMP NULL DEFAULT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);