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
        $user = $this->userService->getUserById($notify->userId);
        
        if ($user && $user->telegramId) {
            // Логика отправки сообщения через Telegram API
            echo "Telegram sent to {$user->telegramId}: {$notify->text}\n";
            return true;
        }

        return false;
    }
}