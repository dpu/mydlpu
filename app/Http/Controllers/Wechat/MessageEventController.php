<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MessageEventController extends Controller
{
    public static function handle($message, $app)
    {
        switch ($message->Event) {
            case 'subscribe':
                return "终于等到你...\n工大A梦伴你同行";
                break;
            case 'unsubscribe':
                return null;
                break;
            case 'SCAN':
                return MessageEventScanController::handle($message);
                break;
            case 'CLICK':
                return (new MessageEventClickController)->handle($message, $app);
                break;
            case 'LOCATION':
                return null;
                break;
            case 'VIEW':
                return null;
                break;
            default:
                return null;
                break;
        }
    }
}