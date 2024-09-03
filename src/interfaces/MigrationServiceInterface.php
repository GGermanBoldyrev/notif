<?php

namespace interfaces;

interface MigrationServiceInterface
{
    // Запуск всех миграций
    public function migrate(string $migrationsPath): void;
}