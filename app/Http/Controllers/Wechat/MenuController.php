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
                "name" => "哆啦A梦",
                "sub_button" => [
                    [
                        "type" => "click",
                        "name" => "教务新闻",
                        "key" => config('wechat.button.news'),
                    ],
                    [
                        "type" => "view",
                        "name" => "期末成绩",
                        "url" => config('wechat.url.prefix') . urlencode(route('scoresCourses')) . config('wechat.url.suffix_base'),
                    ],
                    [
                        "type" => "click",
                        "name" => "等级成绩",
                        "key" => config('wechat.button.score_level'),
                    ],
                    [
                        "type" => "view",
                        "name" => "四级成绩",
                        "url" => config('wechat.url.prefix') . urlencode(route('cet')) . config('wechat.url.suffix_base'),
                    ],
                    [
                        "type" => "miniprogram",
                        "name" => "课表",
                        "appid" => 'wx5ab225cf1ef2ab43',
                        "pagepath" => 'pages/index/index',
                        "url" => 'http://mydlpu.xu42.cn/',
                    ],
                ]
            ],
            [
                "name" => "伴我同行",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "校内电话",
                        "url"  => config('wechat.url.prefix') . urlencode(route('netTel')) . config('wechat.url.suffix_base'),
                    ],
                    [
                        "type" => "click",
                        "name" => "一卡通",
                        "key" => config('wechat.button.ecard'),
                    ],
                    [
                        "type" => "click",
                        "name" => "网络自助",
                        "key" => config('wechat.button.network'),
                    ],
                    [
                        "type" => "view",
                        "name" => "校园地图",
                        "url" => "https://ww1.sinaimg.cn/large/006tNc79gy1ffe5joyusxg31kw1a9n70.gif"
                    ],
                    [
                        "type" => "view",
                        "name" => "学年校历",
                        "url" => "http://api.wx.dlpu.edu.cn/xiaoli"
                    ],
                ]
            ],
            [
                "name" => "神奇口袋",
                "sub_button" => [
//                    [
//                        "type" => "scancode_waitmsg",
//                        "name" => "扫一扫",
//                        "key"  => "B2_SCAN"
//                    ],
                    [
                        "type" => "view",
                        "name" => "快递追踪",
                        "url" => config('wechat.url.prefix') . urlencode(route('express')) . config('wechat.url.suffix_base'),
                    ],
                    [
                        "type" => "click",
                        "name" => "大连天气",
                        "key" => config('wechat.button.weather')
                    ],
                ]
            ],
        ];

        $menu = $app->menu;
        $result = $menu->add($buttons);
        echo $result->errmsg;
    }

    public function get()
    {
        $app = app('wechat');
        $menu = $app->menu;
        $result = $menu->all();
        print_r($result);
    }
}
