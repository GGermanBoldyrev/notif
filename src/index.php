<?php

require __DIR__ . '/../vendor/autoload.php';

use database\Database;
use models\Notify;
use services\MigrationsService;
use services\NotifyCreatorService;
use services\NotifySendersService;
use services\SenderFactoryService;

$database = Database::getInstance();
$notify = new Notify($db);

// Запускаем миграции
$migrationsPath = __DIR__ . '/database/migrations/';
$migrationService = new MigrationsService($database);
$migrationService->migrate($migrationsPath);

$notifyCreator = new NotifyCreatorService($notify);
$notifySendersService = new NotifySendersService($notify);
$senderFactory = new SenderFactoryService();

// Entry point
$senderService = new SenderService($notifyCreator, $senderFactory, $notifySendersService);
$senderService->handle();