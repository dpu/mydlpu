<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MessageShortvideoController extends Controller
{
    public static function handle($message, $app)
    {
        return $message->ThumbMediaId;
    }
}