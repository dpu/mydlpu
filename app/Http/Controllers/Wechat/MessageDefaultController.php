<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;


class MessageDefaultController extends Controller
{
    public static function handle($message, $app)
    {
        return $message->MsgType;
    }
}