<?php

namespace interfaces;

interface NotifyCreator
{
    function create(int $userId, int $periodMinutes, string $text): int;
}