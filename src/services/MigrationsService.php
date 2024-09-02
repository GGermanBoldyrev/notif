<?php

namespace services;

use database\Database;
use interfaces\MigrationServiceInterface;
use PDO;

class MigrationsService implements MigrationServiceInterface
{

    private PDO $database;
    private string $migrationsPath;

    public function __construct(PDO $database, string $migrationsPath)
    {
        $this->database = $database;
        $this->migrationsPath = $migrationsPath;
    }

    public function migrate(): void
    {
        $sqlFiles = glob($this->migrationsPath . '*.sql');
        foreach ($sqlFiles as $file) {
            $sql = file_get_contents($file);
            try {
                $this->database->exec($sql);
                echo "Выполнена миграция: " . basename($file) . PHP_EOL;
            } catch (\PDOException $e) {
                echo "Ошибка выполнения миграции: " . $e->getMessage() . PHP_EOL;
            }
        }
    }
}