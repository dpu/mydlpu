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

        if (preg_match('/[绑定]/', $message->Content) === 1) {
            $url = config('wechat.url.prefix').urlencode(route('eduBinding')).config('wechat.url.suffix_base');
            return '<a href="' . $url . '">点此绑定 教务处系统</a>';
        }

        if (preg_match('/[解绑|解除绑定]/', $message->Content) === 1) {
            $url = config('wechat.url.prefix').urlencode(route('eduBindingRemove')).config('wechat.url.suffix_base');
            return '<a href="' . $url . '">点此解除绑定</a>';
        }

        if ($message->Content == 'openid') {
            return $message->FromUserName;
        }

    }

}