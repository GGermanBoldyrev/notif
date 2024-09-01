<?php

namespace models;


use database\Database;

class User
{
    private $id;
    private $email;
    public ?string $telegram_id;

    public static function find(int $id): ?User
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM `user` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}