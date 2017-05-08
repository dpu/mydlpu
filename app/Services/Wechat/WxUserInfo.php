<?php

namespace App\Services\Wechat;

use App\Services\Service;

class WxUserInfo extends Service
{

    public function push($openid)
    {
        $modelUser = $this->rowByOpenid($openid);
        if (is_null($modelUser)) {
            $info = $this->getUserInfoFromWxByOpenid($openid);
            $this->recordToDB($info);
        }
        if ((time()-strtotime($modelUser->updated_at)) > 3600*24) {
            $info = $this->getUserInfoFromWxByOpenid($openid);
            $this->updateToDB($openid, $info);
        }
    }

    public function getUserInfoFromWxByOpenid($openid)
    {
        return app('wechat')->user->get($openid);
    }

    public function recordToDB($info)
    {
        $modelUser = new \App\Models\WxUsers;

        $modelUser->openid = $info['openid'];
        $modelUser->nickname = $info['nickname'];
        $modelUser->sex = $info['sex'];
        $modelUser->language = $info['language'];
        $modelUser->city = $info['city'];
        $modelUser->province = $info['province'];
        $modelUser->country = $info['country'];
        $modelUser->headimgurl = $info['headimgurl'];
        $modelUser->subscribe_time = $info['subscribe_time'];
        $modelUser->remark = $info['remark'];
        $modelUser->groupid = $info['groupid'];

        $modelUser->save();

        return $modelUser;
    }

    public function rowByOpenid($openid)
    {
        return \App\Models\WxUsers::where('openid', $openid)->first();
    }

    public function updateToDB($openid, $info)
    {
        $modelUser = \App\Models\WxUsers::where('openid', $openid)->first();

        $modelUser->nickname = $info['nickname'];
        $modelUser->sex = $info['sex'];
        $modelUser->language = $info['language'];
        $modelUser->city = $info['city'];
        $modelUser->province = $info['province'];
        $modelUser->country = $info['country'];
        $modelUser->headimgurl = $info['headimgurl'];
        $modelUser->subscribe_time = $info['subscribe_time'];
        $modelUser->remark = $info['remark'];
        $modelUser->groupid = $info['groupid'];

        $modelUser->save();

        return $modelUser;
    }

}