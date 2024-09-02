<?php

namespace models;

use database\Database;
use PDO;

class User
{
    private $id;
    public $email;
    public ?string $telegramId;

    public static function find(int $id): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}