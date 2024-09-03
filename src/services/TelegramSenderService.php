<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;
use services\UserService;

class TelegramSenderService implements SenderNotifyInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function send(Notify $notify): bool
    {
        $user = $this->userService->getUserById($notify->user_id);
        
        if ($user && $user->telegram_id) {
            // Логика отправки сообщения через Telegram API
            echo "Telegram sent to {$user->telegram_id}: {$notify->text}\n";
            return true;
        }

        return false;
    }
}