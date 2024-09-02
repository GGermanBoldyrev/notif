<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;
use models\User;

class EmailSenderService implements SenderNotifyInterface
{
    public function send(Notify $notify): bool
    {
        $user = User::find($notify->userId);
        // Логика отправки email
        echo "Email sent to '$user->email': '$notify->text'\n";
        return true;
    }
}