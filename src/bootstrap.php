<?php

require __DIR__ . '/../vendor/autoload.php';

use Services\NotifyCreatorService;
use Services\NotifySendersServiceImpl;
use Services\SenderFactoryImpl;
use Services\SenderService;

// Инициализация зависимостей
$notifyCreator = new NotifyCreatorService();
$notifySendersService = new NotifySendersServiceImpl();
$senderFactory = new SenderFactoryImpl();

// Создание и запуск основного сервиса
$senderService = new SenderService($notifyCreator, $senderFactory, $notifySendersService);
$senderService->handle();
