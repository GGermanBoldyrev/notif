<?php

namespace services;

use interfaces\NotifyCreatorInterface;
use models\Notify;

class NotifyCreatorService implements NotifyCreatorInterface
{
    private Notify $notify;

    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    public function create(int $userId, int $periodMinutes, string $text): int
    {
        return $this->notify->create($userId, $periodMinutes, $text);
    }
}