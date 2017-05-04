<?php

namespace App\Services\NetWork;

use App\Services\LogService;
use Cn\Xu42\DlpuNetwork\Exception\BaseException;

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
            throw new BaseException('账号密码错误');
        }
        if (empty($network)) throw new BaseException('账号密码错误');
        return $network;
    }

    public function rowByOpenid($openid)
    {
        return \App\Models\NetUsers::where('openid', $openid)->first();
    }

    public function binding($openid, $username, $password, $mobile = '')
    {
        if ($this->rowByOpenid($openid)) {
            return ['icon' => 'info', 'desc' => config('paper.edu.binding.already')];
        }

        try {
            $this->getByProxy($username, $password);
        } catch (\Throwable $t) {
            LogService::edu('NetworkService getByProxy Error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'desc' => $t->getMessage()];
        }

        try {
            $this->recordToDB($openid, $username, $password, $mobile);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.success')];
        } catch (\Throwable $t) {
            LogService::edu('NetworkService recordToDB error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'title' => config('paper.edu.binding.error')];
        }
    }

    public function removeBinding($openid)
    {
        if ($this->rowByOpenid($openid)) {
            $removeRes = $this->removeFromDB($openid);
            LogService::edu('Edu removeBinding success...', [$openid]);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.remove_success')];
        }
        LogService::edu('Edu removeBinding error...', [$openid]);
        return ['icon' => 'warn', 'title' => config('paper.edu.binding.have_no')];
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