<?php

namespace App\Common;

class Config
{
    public static function wechatShareConfig()
    {
        $app = app('wechat');
        return $app->js->config([
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareQZone'
        ], false);
    }
}