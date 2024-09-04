<?php

namespace interfaces;

interface UserCreatorInterface
{
    function create(string $email, ?string $telegramId = null, ?string $chatId = null): int;
}