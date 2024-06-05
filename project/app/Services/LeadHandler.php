<?php

namespace App\Services;

use LeadGenerator\Lead;

class LeadHandler
{
    public function handle(Lead $lead)
    {
        $config = Config::instance()->get('logs');
        $logger = new Logger($config['log_path']);
        $logger->addLine($lead->id.' | '.$lead->categoryName.' | '.date('Y-m-d H:i:s'));

        sleep(2);
    }
}