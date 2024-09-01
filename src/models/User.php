<?php

namespace Models;

use Database\Database;

class User
{
    private $id;
    private $email;
    public ?string $telegram_id;

    public static function find(int $id): ?User
    {
        $db = new Database();
    }
}