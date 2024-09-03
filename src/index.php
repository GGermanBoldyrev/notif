<?php

require __DIR__ . '/../vendor/autoload.php';

use database\Database;
use models\Notify;
use models\User;
use services\MigrationsService;
use services\NotifyCreatorService;
use services\UserCreatorService;
use services\NotifySendersService;
use services\SenderFactoryService;
use services\UserService;

$database = Database::getInstance();
$notify = new Notify($db);
$user = new User($db);

// Запускаем миграции
$migrationsPath = __DIR__ . '/database/migrations/';
$migrationService = new MigrationsService($database);
$migrationService->migrate($migrationsPath);

$notifyCreator = new NotifyCreatorService($notify);
$userCreator = new UserCreatorService($user);
$notifySendersService = new NotifySendersService($notify);
$userService = new UserService($database);
$senderFactory = new SenderFactoryService($userService);

// Entry point
$senderService = new SenderService($notifyCreator, $userCreator, $senderFactory, $notifySendersService);
$senderService->handle();