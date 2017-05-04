<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => false,

    /*
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => 'wx75ecd24309ff9760',
    'secret'  => 'f034ef8cd2b940e8a1fe09d63e1cd390',
    'token'   => 'wechat',
    'aes_key' => 'osrHn9AnhXbHpL5flWWiGzTXUmaob2hiQNKTeikOwqK',

    /**
     * 开放平台第三方平台配置信息
     */
    //'open_platform' => [
        /**
         * 事件推送URL
         */
        //'serve_url' => env('WECHAT_OPEN_PLATFORM_SERVE_URL', 'serve'),
    //],
    
    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => 'debug',
        'file'  => storage_path('logs/wechat.log'),
    ],
    'url' => [
        'prefix' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75ecd24309ff9760&redirect_uri=',
        'suffix_base' => '&response_type=code&scope=snsapi_base&state=1#wechat_redirect',
        'suffix_userinfo' => '&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect',
    ],
    'button' =>[
        'timetable' => 'TIMETABLE', //课表(目前只做今明两天的课表, 更多课表从小程序获取)
        'score_level' => 'SCORE_LEVEL', //等级成绩
        'exams' => 'EXAMS', //考试安排
        'news' => 'NEWS', //新闻动态
        'feedback' => 'FEEDBACK', //反馈
        'about' => 'ABOUT', //关于
        'ecard' => 'ECARD', //校园卡(一卡通)
    ],

    /*
     * OAuth 配置
     *
     * only_wechat_browser: 只在微信浏览器跳转
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
     */
     'oauth' => [
         'only_wechat_browser' => false,
         'scopes'   => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_base'))),
         'callback' => env('WECHAT_OAUTH_CALLBACK', 'wechat_oauth_callback'),
     ],

    /*
     * 微信支付
     */
    // 'payment' => [
    //     'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', 'your-mch-id'),
    //     'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
    //     'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH', 'path/to/your/cert.pem'), // XXX: 绝对路径！！！！
    //     'key_path'           => env('WECHAT_PAYMENT_KEY_PATH', 'path/to/your/key'),      // XXX: 绝对路径！！！！
    //     // 'device_info'     => env('WECHAT_PAYMENT_DEVICE_INFO', ''),
    //     // 'sub_app_id'      => env('WECHAT_PAYMENT_SUB_APP_ID', ''),
    //     // 'sub_merchant_id' => env('WECHAT_PAYMENT_SUB_MERCHANT_ID', ''),
    //     // ...
    // ],

    /*
     * 开发模式下的免授权模拟授权用户资料
     *
     * 当 enable_mock 为 true 则会启用模拟微信授权，用于开发时使用，开发完成请删除或者改为 false 即可
     */
//     'enable_mock' => env('WECHAT_ENABLE_MOCK', false),
//     'mock_user' => [
//         "openid" =>"ol_LCw0IAYwE7m3tFKwgvjUKHxa8",
//         // 以下字段为 scope 为 snsapi_userinfo 时需要
//         "nickname" => "许杨淼淼",
//         "sex" =>"0",
//         "province" =>"北京",
//         "city" =>"北京",
//         "country" =>"中国",
//         "headimgurl" => "http://wx.qlogo.cn/mmopen/ajNVdqHZLLCFLeNaHw4GdSBq7mHS1GV3HMjCr9546BcGMCicIrNiaS4ktLQHPf0QDr9c5GFFbhrDAZkeH3KEf3e4FUV2E3o2LXlyhY5OontrY/0",
//     ],
];
