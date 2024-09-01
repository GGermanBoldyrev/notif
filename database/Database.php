<?php

namespace Database;

use PDO;

class Database
{
    private static PDO $instance;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/database.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
        self::$instance = new PDO($dsn, $config['user'], $config['password']);
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getInstance(): PDO
    {
        return self::$instance;
    }
}
