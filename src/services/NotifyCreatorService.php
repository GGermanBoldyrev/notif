<?php

namespace services;

use interfaces\NotifyCreatorInterface;
use models\Notify;

class NotifyCreatorService implements NotifyCreatorInterface
{
    public function create(int $userId, int $periodMinutes, string $text): int
    {
        return Notify::create($userId, $periodMinutes, $text);
    }
}