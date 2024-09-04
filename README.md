## Тестовое задание (Сервис отправки уведомлений)

### Клонирование репозитория
1) git clone https://github.com/GGermanBoldyrev/notif.git
2) cd notif
3) composer install
4) mv config/config-example.php config/config.php
5) Настроить подключение к базе данных и тг токен в config/config.php
6) Для корректной рассылки настроить создание пользователей и уведомлений в SenderService.php

### Telegram бот для рассылки
1) Создать бота, получить ключ и вставить его в config.php
2) Нажать старт и найти свой chat_id
3) В SenderService вставить chat_id чтобы проверить 

### Почта для рассылки
1) Необходимо в config.php указать свою gmail почту и пароль
2) Если у Вас 2-х факторная авторизиция то необходимо для PHPMailer создать пароль во вкладке App passwords

### Запуск сервиса
1) php src/index.php