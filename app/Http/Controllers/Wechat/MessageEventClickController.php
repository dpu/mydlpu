<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MessageEventClickController extends Controller
{
    public static function handle($message)
    {
        switch ($message->EventKey) {
            case 'B0_SCORE_FINAL':
                return Plugins\Education::index($message, 'scoreFinal');
                break;
            case 'B0_SCORE_LEVEL':
                return Plugins\Education::index($message, 'levelScores');
                break;
            case 'B0_SCORE_CET':
                return Plugins\Education::scoreCet($message);
                break;
            case 'B0_SCORE_REBUILT':
                return Plugins\Education::index($message, 'scoreRebuilt');
                break;
            case 'B0_TIMETABLE':
                return Plugins\Education::index($message, 'timetable');
                break;
            case 'B1_ECARD':
                return Plugins\Education::index($message, 'ecard');
                break;
            case 'B0_EXAMSINFO':
                return Plugins\Education::index($message, 'examsInfo');
                break;
            case 'B1_NETWORK':
                return Plugins\Network::config($message);
                break;
            case 'B0_BOOK':
                return Plugins\Education::index($message, 'book');
                break;
            case 'B0_NEWS':
                return Plugins\Education::index($message, 'news');
                break;
            case 'B1_TEL':
                return null;
                break;
            case 'B1_MAP':
                return Messages\Image::map();
                break;
            case 'B1_CALENDAR':
                return Messages\Image::calendar();
                break;
            case 'B2_SCAN':
                return null;
                break;
            case 'B2_EXPRESS':
                return Plugins\ExpressTracking::click($message);
                break;
            case 'B2_WEATHER':
                return Plugins\Weather::get($message);
                break;
            case 'B2_WEATHER_HZ':
                return Plugins\Weather::getHZ($message);
                break;
            case 'B2_FEEDBACK':
                return Plugins\FeedBack::click($message);
                break;
            case 'B2_ABUT':
                return Plugins\About::click($message);
                break;
            default :
                return null;
                break;
        }
    }
}
