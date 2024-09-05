<?php

namespace models;

use DateTime;
use PDO;

class Notify
{
    private ?PDO $db;

    public int $id;
    public int $user_id;
    public int $period_minutes;
    public string $text;
    public ?string $last_sent_at;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db;
    }

    public function create(int $userId, int $periodMinutes, string $text) : int 
    {
        if (!$this->notificationExists($userId, $periodMinutes, $text)) {
            $stmt = $this->db->prepare("INSERT INTO notifications (user_id, period_minutes, text) VALUES (:user_id, :period_minutes, :text)");
            $stmt->execute(['user_id' => $userId, 'period_minutes' => $periodMinutes, 'text' => $text]);
            return $this->db->lastInsertId();
        }
        return 0;
    }

    public function getNotSends(DateTime $dateTime): array
    {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE last_sent_at IS NULL OR TIMESTAMPDIFF(MINUTE, last_sent_at, :currentTime) >= period_minutes");
        $stmt->execute(['currentTime' => $dateTime->format('Y-m-d H:i:s')]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function setNotificationSended(int $notifyId, DateTime $dateTime) : void
    {
        $stmt = $this->db->prepare("UPDATE notifications SET last_sent_at = :dateNow WHERE id = :id");
        $stmt->execute([
            'dateNow' => $dateTime->format('Y-m-d H:i:s'),
            'id' => $notifyId
        ]);
    }

    private function notificationExists(int $userId, int $periodMinutes, string $text): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM notifications 
            WHERE user_id = :user_id AND period_minutes = :period_minutes AND text = :text"
        );
        $stmt->execute([
            'user_id' => $userId,
            'period_minutes' => $periodMinutes,
            'text' => $text
        ]);
        return $stmt->fetchColumn() > 0;
    }
}