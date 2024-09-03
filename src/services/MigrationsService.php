<?php

namespace services;

use database\Database;
use interfaces\MigrationServiceInterface;
use PDO;

class MigrationsService implements MigrationServiceInterface
{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function migrate(string $migrationsPath): void
    {
        $sqlFiles = glob($migrationsPath . '*.sql');
        foreach ($sqlFiles as $file) {
            $sql = file_get_contents($file);
            $this->database->exec($sql);
            echo "Выполнена миграция: " . basename($file) . PHP_EOL;
        }
    }
}