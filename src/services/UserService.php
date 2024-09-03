<?php

namespace services;

use models\User;
use PDO;

class UserService
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUserById(int $id): ?User
    {
        $user = new User($this->db);
        return $user->find($id);
    }
}
