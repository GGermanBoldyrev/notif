## Тестовое задание (Сервис отправки уведомлений)

1) git clone https://github.com/GGermanBoldyrev/notif.git
2) cd notif
3) composer install
4) mv config/config-example.php config/config.php
5) Настроить подключение к базе данных и тг токен в config/config.php
6) Для корректной рассылки настроить создание пользователей и уведомлений в SenderService.php

## Запуск сервиса
1) php src/index.php