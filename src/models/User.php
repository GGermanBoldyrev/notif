<?php

namespace models;

use interfaces\UserCreatorInterface;
use PDO;

class User implements UserCreatorInterface
{
    private ?PDO $db;

    private int $id;
    public string $email;
    public ?string $telegram_id;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db;
    }

    public function find(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(User::class) ?: null;
    }

    public function create(string $email, ?string $telegramId = null): int
    {
        if (!$this->emailExists($email)) {
            $stmt = $this->db->prepare("INSERT INTO users (email, telegram_id) VALUES (:email, :telegram_id)");
            $stmt->execute(['email' => $email, 'telegram_id' => $telegramId]);
            return $this->db->lastInsertId();
        }
        return 0;
    }

    private function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}