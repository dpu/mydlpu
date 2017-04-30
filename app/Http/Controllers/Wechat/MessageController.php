<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public static function handle($message, $app)
    {
        switch ($message->MsgType) {
            case 'event':
                return MessageEventController::handle($message, $app);
                break;
            case 'image':
                return MessageImageController::handle($message, $app);
                break;
            case 'link':
                return MessageLinkController::handle($message, $app);
                break;
            case 'location':
                return MessageLocationController::handle($message, $app);
                break;
            case 'shortvideo':
                return MessageShortvideoController::handle($message, $app);
                break;
            case 'text':
                return MessageTextController::handle($message, $app);
                break;
            case 'video':
                return MessageVideoController::handle($message, $app);
                break;
            case 'voice':
                return MessageVoiceController::handle($message, $app);
                break;
            default:
                return MessageDefaultController::handle($message, $app);
                break;
        }
    }

}

