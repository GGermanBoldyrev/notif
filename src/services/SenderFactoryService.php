<?php

namespace services;

use interfaces\SenderFactoryInterface;
use enums\SenderTypes;
use interfaces\SenderNotifyInterface;

class SenderFactoryService implements SenderFactoryInterface
{
    private UserService $userService;
    private EmailService $emailService;
    private array $config;

    public function __construct(UserService $userService, EmailService $emailService, array $config)
    {
        $this->userService = $userService;
        $this->emailService = $emailService;
        $this->config = $config;
    }

    public function make(SenderTypes $type): SenderNotifyInterface
    {
        return match ($type) {
            SenderTypes::Telegram => new TelegramSenderService($this->userService, $this->config),
            SenderTypes::Email => new EmailSenderService($this->userService, $this->emailService),
        };
    }
}
