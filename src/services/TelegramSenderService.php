<?php

namespace services;

use interfaces\SenderNotifyInterface;
use models\Notify;

class TelegramSenderService implements SenderNotifyInterface
{
    private UserService $userService;
    private array $config;

    public function __construct(UserService $userService, array $config)
    {
        $this->userService = $userService;
        $this->config = $config;
    }

    public function send(Notify $notify): bool
    {
        $user = $this->userService->getUserById($notify->user_id);

        if ($user && $user->chat_id) {
            $url = "https://api.telegram.org/bot{$this->config['tg_token']}/sendMessage?chat_id={$user->chat_id}&text={$notify->text}";
            $response = file_get_contents($url);
            $response = json_decode($response, true);
            if ($response['ok']) {
                echo "Телеграм уведомление отправлено {$user->telegram_id}: {$notify->text}\n";
                return true;
            } else {
                echo "Ошибка при отправке сообщения для {$user->telegram_id}";
                return false;
            }
        }

        return false;
    }
}