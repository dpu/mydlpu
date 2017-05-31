<?php

namespace App\Jobs;

use App\Services\Wechat\WxUserInfo;

class SaveWxUserInfoJob extends Job
{
    public $tries = 5;

    public $timeout = 120;

    protected $openid;

    public function __construct($openid)
    {
        $this->openid = $openid;
    }

    public function handle()
    {
        $wxUserInfoService = new WxUserInfo;
        $wxUserInfoService->push($this->openid);
    }
}