<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;
use services\UserService;

class EmailSenderService implements SenderNotifyInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function send(Notify $notify): bool
    {
        $user = $this->userService->getUserById($notify->userId);

        if ($user && $user->email) {
            // Логика отправки email
            echo "Email sent to '$user->email': '$notify->text'\n";
            return true;
        }

        return false;
    }
}