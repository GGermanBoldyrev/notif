<?php

namespace models;

use database\Database;
use interfaces\NotifyCreatorInterface;
use interfaces\NotifySendersServiceInterface;

class Notify implements NotifyCreatorInterface, NotifySendersServiceInterface
{
    public int $id;
    public int $userId;
    public int $period;
    public string $text;
    public ?string $lastSentAt;

    public static function create(int $userId, int $periodMinutes, string $text) : int 
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO notifications (user_id, period_minutes, text) VALUES (:user_id, :period_minutes, :text)");
        $stmt->execute(['user_id' => $userId, 'period_minutes' => $periodMinutes, 'text' => $text]);
        return $db->lastInsertId();
    }

    public static function getNotSends(DateTime $dateTime): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM notifications WHERE last_sent_at IS NULL OR last_sent_at <= :date_time");
        $stmt->execute(['date_time' => $dateTime]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function setNotificationSended(int $notifyId, SenderTypes $type) : void
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE notifications SET last_sent_at = NOW() WHERE id = :id");
        $stmt->execute(['id' => $notifyId]);
    }
}