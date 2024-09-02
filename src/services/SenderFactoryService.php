<?php

namespace services;

use interfaces\SenderFactoryInterface;
use enums\SenderTypes;
use interfaces\SenderNotifyInterface;

class SenderFactoryService implements SenderFactoryInterface
{
    public function make(SenderTypes $type): SenderNotifyInterface
    {
        return match ($type) {
            SenderTypes::Telegram => new TelegramSenderService(),
            SenderTypes::Email => new EmailSenderService(),
        };
    }
}
