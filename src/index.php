<?php

require __DIR__ . '/../vendor/autoload.php';

use database\Database;
use services\MigrationsService;

$database = Database::getInstance();

// Запускаем миграции
$migrationsPath = __DIR__ . '/database/migrations/';
$migrationService = new MigrationsService($database, $migrationsPath);
$migrationService->migrate();

var_dump(\models\User::find(2));