<?php

namespace models;

use database\Database;
use interfaces\NotifyCreatorInterface;

class Notify implements NotifyCreatorInterface
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
}