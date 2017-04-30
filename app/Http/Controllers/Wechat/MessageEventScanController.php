<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MessageEventScanController extends Controller
{
    public static function handle( $message )
    {
        return 'MessageEventScanController';
    }

}