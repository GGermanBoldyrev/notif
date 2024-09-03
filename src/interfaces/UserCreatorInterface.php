<?php

namespace interfaces;

interface UserCreatorInterface
{
    function create(string $email, ?string $telegramId = null): int;
}