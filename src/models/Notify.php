<?php

namespace models;

use database\Database;
use enums\SenderTypes;
use interfaces\NotifyCreatorInterface;
use interfaces\NotifySendersServiceInterface;
use PDO;

class Notify implements NotifyCreatorInterface, NotifySendersServiceInterface
{
    private PDO $db;

    public int $id;
    public int $userId;
    public int $period;
    public string $text;
    public ?string $lastSentAt;

    public function __construct(PDO $db)
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
    }

    public function getNotSends(DateTime $dateTime): array
    {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE last_sent_at IS NULL OR TIMESTAMPDIFF(MINUTE, last_sent_at, :currentTime) >= period_minutes");
        $stmt->execute(['currentTime' => $dateTime->format('Y-m-d H:i:s')]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Notify::class);
    }

    public function setNotificationSended(int $notifyId, SenderTypes $type, DateTime $dateTime) : void
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