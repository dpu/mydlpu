<?php

namespace App\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogService extends Service
{
    public static function default($message, $arr)
    {
        $log = new Logger(config('monolog.default.name'));
        $stream = new StreamHandler(config('monolog.default.path'), config('monolog.default.level'));
        $log->pushHandler($stream);
        $log->info($message, $arr);
    }

    public static function cet($message, $arr)
    {
        $log = new Logger(config('monolog.cet.name'));
        $stream = new StreamHandler(config('monolog.cet.path'), config('monolog.cet.level'));
        $log->pushHandler($stream);
        $log->info($message, $arr);
    }

    public static function express($message, $arr)
    {
        $log = new Logger(config('monolog.express.name'));
        $stream = new StreamHandler(config('monolog.express.path'), config('monolog.express.level'));
        $log->pushHandler($stream);
        $log->info($message, $arr);
    }


}