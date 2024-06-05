<?php

return [
    'queue' => [
        'host' => 'redis',
        'port' => 6379
    ],
    'logs' => [
        'log_path' => ROOT_DIR.'/log.txt',
    ],
    'lead_generator' => [
        'queue_name' => 'leads',
    ]
];