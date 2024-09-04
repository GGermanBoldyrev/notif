<?php

namespace database;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(array $config): ?PDO
    {
        if (!self::$instance) {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            self::$instance = new PDO($dsn, $config['user'], $config['password']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$instance;
    }
}
