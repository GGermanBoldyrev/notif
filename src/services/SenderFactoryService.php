<?php

namespace services;

use interfaces\SenderFactoryInterface;
use enums\SenderTypes;
use interfaces\SenderNotifyInterface;
use services\UserService;

class SenderFactoryService implements SenderFactoryInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;    
    }

    public function make(SenderTypes $type): SenderNotifyInterface
    {
        return match ($type) {
            SenderTypes::Telegram => new TelegramSenderService($this->userService),
            SenderTypes::Email => new EmailSenderService($this->userService),
        };
    }
}
