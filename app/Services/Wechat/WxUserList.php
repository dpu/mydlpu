<?php

namespace App\Services\Wechat;

use App\Services\Service;

class WxUserList extends Service
{
    public function get()
    {
        return app('wechat')->user->lists();
    }
}