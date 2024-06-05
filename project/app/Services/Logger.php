<?php

namespace App\Services;

class Logger
{
    public function __construct(protected string $filePath)
    {
    }

    public function addLine(string $message): void
    {
        file_put_contents($this->filePath, $message.PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}