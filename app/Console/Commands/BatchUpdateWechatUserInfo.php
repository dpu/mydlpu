<?php

namespace App\Console\Commands;

use App\Services\Wechat\WxUserList;
use Illuminate\Console\Command;


class BatchUpdateWechatUserInfo extends Command
{
    protected $signature = 'batch:wechat';

    protected $description = 'Batch Update Wechat UserInfo ...';

    public function handle()
    {
        $userList = (new WxUserList)->get();
        $openids = $userList['data']['openid'] ?? [];
        foreach ($openids as $openid) {
            dispatch((new \App\Jobs\SaveWxUserInfoJob($openid))->onQueue('wxUserInfo'));
        }
    }

}