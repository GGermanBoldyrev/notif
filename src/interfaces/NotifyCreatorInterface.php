<?php

namespace interfaces;

interface NotifyCreatorInterface
{
    function create(int $userId, int $periodMinutes, string $text): int;
}