<?php

namespace services;

class NotifyCreatorService implements NotifyCreatorInterface
{
    private function create(int $userId, int $periodMinutes, string $text): int
    {
        return Notify::create(userId, periodMinutes, text);
    }
}