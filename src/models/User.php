<?php

namespace models;

use database\Database;
use interfaces\UserCreatorInterface;
use PDO;

class User implements UserCreatorInterface
{
    private PDO $db;

    private $id;
    public $email;
    public ?string $telegramId;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public static function find(int $id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $email, ?string $telegramId = null): int
    {
        if (!$this->emailExists($email)) {
            $stmt = $this->db->prepare("INSERT INTO users (email, telegram_id) VALUES (:email, :telegram_id)");
            $stmt->execute(['email' => $email, 'telegram_id' => $telegramId]);
            return $this->db->lastInsertId();
        }
    }

    private function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}