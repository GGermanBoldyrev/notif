<?php

namespace services;

use interfaces\SenderFactoryInterface;
use enums\SenderTypes;
use interfaces\SenderNotifyInterface;
use services\UserService;

class SenderFactoryService implements SenderFactoryInterface
{
    private UserService $userService;
    private array $config;

    public function __construct(UserService $userService, array $config)
    {
        $this->userService = $userService;
        $this->config = $config;
    }

    public function make(SenderTypes $type): SenderNotifyInterface
    {
        return match ($type) {
            SenderTypes::Telegram => new TelegramSenderService($this->userService, $this->config),
            SenderTypes::Email => new EmailSenderService($this->userService),
        };
    }
}
