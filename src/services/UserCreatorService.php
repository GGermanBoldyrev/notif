<?php

namespace services;

use interfaces\UserCreatorInterface;
use models\User;

class UserCreatorService implements UserCreatorInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(string $email, ?string $telegramId = null): int
    {
        return $this->user->create($email, $telegramId);
    }
}