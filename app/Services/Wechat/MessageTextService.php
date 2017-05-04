<?php

namespace App\Services\Wechat;

use App\Services\Service;
use EasyWeChat\Message\Text;

class MessageTextService extends Service
{
    public static function simple($textContent = '')
    {
        return new Text(['content' =>  $textContent]);
    }

    public static function ing()
    {
        return new Text(['content' =>  '正在为您查询...']);
    }

    public static function errorCetArgument()
    {
        return new Text(['content' =>  config('paper.cet.error.argument')]);
    }

    public static function bindingEdu()
    {
        $url = config('wechat.url.prefix').urlencode(route('eduBinding')).config('wechat.url.suffix_base');
        return new Text(['content' =>  '请先绑定教务系统 <a href="' . $url . '">点此绑定</a>']);
    }

    public static function bindingNet()
    {
        $url = config('wechat.url.prefix').urlencode(route('netBinding')).config('wechat.url.suffix_base');
        return new Text(['content' =>  '请先绑定网络自助 <a href="' . $url . '">点此绑定</a>']);
    }

}
