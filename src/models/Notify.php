<?php

namespace models;

class Notify 
{
    public int $id;
    public int $userId;
    public int $period;
    public string $text;
    public ?string $last_sent_at;

    public function create(int $userId, int $periodMinutes, string $text) : int 
    {
        
    }
}