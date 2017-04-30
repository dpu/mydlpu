<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Services\Cet\CetService;

class MessageTextController extends Controller
{
    public static function handle($message, $app)
    {
        // 四级查询: 回复【cet+姓名+准考证号】
        if (strtolower(substr($message->Content, 0, 3)) == 'cet') {
            return (new CetService)->get($message->FromUserName, $message->Content, $app);
        }

        if ($message->Content == 'openid') {
            return $message->FromUserName;
        }

    }

}