<?php

namespace App\Services\NetWork;

class NetworkService
{
    const URL_DLPU_NETWORK_PROXY = 'http://myproject.dlpu.edu.cn/network/debug.php?username=%s&password=%s';

    public function getByProxy($username, $password)
    {
        try {
            $url = sprintf(self::URL_DLPU_NETWORK_PROXY, $username, $password);
            $network = file_get_contents($url);
            $network = json_decode($network, true);
        } catch (\Throwable $t) {
            $network = [];
        }
        return $network;
    }

    public function rowByOpenid($openid)
    {
        return \App\Models\NetUsers::where('openid', $openid)->first();
    }

    private function recordToDB($openid, $username, $password, $mobile)
    {
        $modelEduUser = new \App\Models\EduUsers;
        $modelEduUser->openid = $openid;
        $modelEduUser->username = $username;
        $modelEduUser->password = $password;
        $modelEduUser->mobile = $mobile;
        $modelEduUser->save();
        return $modelEduUser;
    }

    private function removeFromDB($openid)
    {
        $modelEduUser = \App\Models\EduUsers::where('openid', $openid)->delete();
        return is_null($modelEduUser) ? false : true;
    }


}