<?php

namespace App\Services;

use Predis\Client;
use AndrewBreksa\RSMQ\RSMQClient;

class QueueClient
{
    public static function instance(): RSMQClient
    {
        static $instance = null;

        if (is_null($instance)) {
            $predis = new Client(Config::instance()->get('queue'));
            $instance = new RSMQClient($predis);
        }

        return $instance;
    }
}