<?php

require __DIR__ . '/../vendor/autoload.php';

use database\Database;
use models\Notify;
use models\User;
use services\MigrationsService;
use services\NotifyCreatorService;
use services\SenderService;
use services\UserCreatorService;
use services\NotifySendersService;
use services\SenderFactoryService;
use services\UserService;

// Конфиг
$config = require __DIR__ . '/../config/config.php';

$database = Database::getInstance($config);
$notify = new Notify($database);
$user = new User($database);

// Запускаем миграции
$migrationsPath = __DIR__ . '/database/migrations/';
$migrationService = new MigrationsService($database);
$migrationService->migrate($migrationsPath);

$notifyCreator = new NotifyCreatorService($notify);
$userCreator = new UserCreatorService($user);
$notifySendersService = new NotifySendersService($notify);
$userService = new UserService($database);
$senderFactory = new SenderFactoryService($userService, $config);

// Entry point
$senderService = new SenderService($notifyCreator, $userCreator, $senderFactory, $notifySendersService);
$senderService->handle();