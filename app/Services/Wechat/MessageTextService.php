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


    public static function registerNetwork($message)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "=== 未绑定校园网自助 ===\n\n回复: 网络 学号 密码\n例: 网络 1305040301 passwd\n注：不要忘记是有空格的～";
        return $text;
    }

    public static function networkConfig($content)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "=== 校园网配置信息 ===\n\nIP：$content[0]\nMAC：$content[1]\n接入点：$content[3]\n类型：$content[4]\n";
        return $text;
    }

    public static function binding()
    {
        return new Text(['content' =>  '请先绑定教务系统 <a href="' . config('edu.url.binding') . '">点此绑定</a>']);
    }

}
