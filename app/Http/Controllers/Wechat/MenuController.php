<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * 创建微信自定义菜单
     */
    public function add()
    {
        $app = app('wechat');

        $buttons = [
            [
                "name"       => "哆啦A梦",
                "sub_button" => [
                    [
                        "type" => "click",
                        "name" => "今明课表",
                        "key"  => "B0_TIMETABLE"
                    ],
                    [
                        "type" => "click",
                        "name" => "期末成绩",
                        "key"  => "B0_SCORE_FINAL"
                    ],
                    [
                        "type" => "click",
                        "name" => "等级成绩",
                        "key"  => "B0_SCORE_LEVEL"
                    ],
//                    [
//                        "type" => "click",
//                        "name" => "四级成绩",
//                        "key"  => "B0_SCORE_CET"
//                    ],
                    [
                        "type" => "view",
                        "name" => "四级成绩",
                        "url"  => url('query/cet')
                    ],
                    [
                        "type" => "click",
                        "name" => "考试安排",
                        "key"  => "B0_EXAMSINFO"
                    ],
                    //                    [
                    //                        "type" => "click",
                    //                        "name" => "新闻动态",
                    //                        "key"  => "B0_NEWS"
                    //                    ]
                ]
            ],
            [
                "name"       => "伴我同行",
                "sub_button" => [
//                    [
//                        "type" => "click",
//                        "name" => "工大部落",
//                        "key"  => "B1_BBS"
//                    ],
//                    [
//                        "type" => "click",
//                        "name" => "校内电话",
//                        "key"  => "B1_TEL"
//                    ],
[
    "type" => "click",
    "name" => "校园卡",
    "key"  => "B1_ECARD"
],
[
    "type" => "click",
    "name" => "网络自助",
    "key"  => "B1_NETWORK"
],
[
    "type" => "click",
    "name" => "校园地图",
    "key"  => "B1_MAP"
],
[
    "type" => "click",
    "name" => "学年校历",
    "key"  => "B1_CALENDAR"
],
                ]
            ],
            [
                "name"       => "神奇口袋",
                "sub_button" => [
//                    [
//                        "type" => "scancode_waitmsg",
//                        "name" => "扫一扫",
//                        "key"  => "B2_SCAN"
//                    ],
                    [
                        "type" => "view",
                        "name" => "快递追踪",
                        "url"  => "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75ecd24309ff9760&redirect_uri=http%3a%2f%2fngrok.mydlpu.xu42.cn%2fh5%2fexpress&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                    ],
[
    "type" => "click",
    "name" => "大连天气",
    "key"  => "B2_WEATHER"
],
[
    "type" => "click",
    "name" => "杭州天气",
    "key"  => "B2_WEATHER_HZ"
],
//                    [
//                        "type" => "click",
//                        "name" => "反馈建议",
//                        "key"  => "B2_FEEDBACK"
//                    ],
//                    [
//                        "type" => "click",
//                        "name" => "关于",
//                        "key"  => "B2_ABUT"
//                    ]
                ]
            ],
        ];

        $menu   = $app->menu;
        $result = $menu->add($buttons);
        var_dump($result);
    }
}