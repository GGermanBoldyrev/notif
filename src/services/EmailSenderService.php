<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;

class EmailSenderService implements SenderNotifyInterface
{
    private UserService $userService;
    private EmailService $emailService;

    public function __construct(UserService $userService, EmailService $emailService)
    {
        $this->userService = $userService;
        $this->emailService = $emailService;
    }

    public function send(Notify $notify): bool
    {
        $user = $this->userService->getUserById($notify->user_id);

        if ($user && $user->email) {
            $sent = $this->emailService->sendEmail(
                $user->email,
                'Рассылка уведомлений',
                $notify->text);
            if ($sent) {
                echo "Электронное письмо отправлено '$user->email': '$notify->text'\n";
                return true;
            } else {
                echo "Не удалось отправить электронное письмо '$user->email': '$notify->text'\n";
                return false;
            }
        }

        return false;
    }
}