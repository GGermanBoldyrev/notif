<?php

namespace services;

use interfaces\SenderFactoryInterface;
use interfaces\SenderNotifyInterface;
use enums\SenderTypes;

class SenderFactoryImpl implements SenderFactory
{
    public function make(SenderTypes $type): SenderNotify
    {
        return match ($type) {
            SenderTypes::Telegram => new TelegramSender(),
            SenderTypes::Email => new EmailSender(),
        };
    }
}
