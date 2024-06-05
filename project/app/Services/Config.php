<?php

namespace App\Services;

class Config
{
    protected array $config;

    protected function __construct()
    {
        $this->config = require CONFIG_DIR.'/general.php';
    }

    public static function instance(): static
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new static();
        }

        return $instance;
    }

    public function get(string $path): mixed
    {
        return $this->config[$path];
    }
}