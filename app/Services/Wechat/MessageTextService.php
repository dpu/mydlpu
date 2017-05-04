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
        return new Text(['content' =>  '请先绑定教务系统 <a href="' . config('edu.url.binding_edu') . '">点此绑定</a>']);
    }

    public static function bindingNet()
    {
        return new Text(['content' =>  '请先绑定网络自助 <a href="' . config('edu.url.binding_net') . '">点此绑定</a>']);
    }

}
