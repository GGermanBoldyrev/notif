<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;
use models\User;

class TelegramSenderService implements SenderNotifyInterface
{
    public function send(Notify $notify): bool
    {
        $user = User::find($notify->user_id);
        // Логика отправки сообщения через Telegram API
        echo "Telegram sent to {$user->telegram_id}: {$notify->text}\n";
        return true;
    }
}