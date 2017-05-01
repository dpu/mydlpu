<?php

use Monolog\Logger;

return [
    'default' => [
        'name' => 'default',
        'level' => Logger::DEBUG,
        'path' => storage_path('logs/default.log')
    ],
    'cet' => [
        'name' => 'cet',
        'level' => Logger::DEBUG,
        'path' => storage_path('logs/cet.log')
    ],
    'express' => [
        'name' => 'express',
        'level' => Logger::DEBUG,
        'path' => storage_path('logs/express.log')
    ],
    'edu' => [
        'name' => 'edu',
        'level' => Logger::DEBUG,
        'path' => storage_path('logs/edu.log')
    ],

];

