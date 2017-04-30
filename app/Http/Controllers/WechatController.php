<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Wechat\MessageController;

class WechatController extends Controller
{
    public function serve()
    {
        $app = app('wechat');

        $app->server->setMessageHandler(function ($message) use ($app) {
            return MessageController::handle($message, $app);
        });

        return $app->server->serve();
    }

    public function callback()
    {
        $app = app('wechat');
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $_SESSION['wechat_user'] = $user->toArray();
        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
        header('location:' . $targetUrl);
    }
}
