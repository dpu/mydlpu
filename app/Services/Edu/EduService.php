<?php

namespace App\Services\Edu;

use App\Services\LogService;
use Cn\Xu42\Qznjw2014\Account\Service\AccountService;

class EduService
{

    public function binding($openid, $username, $password, $mobile = '')
    {
        if ($this->isBinding($openid)) {
            return ['icon' => 'info', 'desc' => config('paper.edu.binding.already')];
        }

        try {
            $token = (new AccountService)->getToken($username, $password);
        } catch (\Throwable $t) {
            LogService::edu('Edu getToken Error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'desc' => $t->getMessage()];
        }

        try {
            $this->recordToDB($openid, $username, $password, $mobile);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.success')];
        } catch (\Throwable $t) {
            LogService::edu('Edu recordToDB error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'title' => config('paper.edu.binding.error')];
        }
    }


    public function removeBinding($openid)
    {
        if ($this->isBinding($openid)) {
            $removeRes = $this->removeFromDB($openid);
            LogService::edu('Edu removeBinding success...', [$openid]);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.remove_success')];
        }
        LogService::edu('Edu removeBinding error...', [$openid]);
        return ['icon' => 'warn', 'title' => config('paper.edu.binding.have_no')];
    }


    private function isBinding($openid)
    {
        $modelEduUser = \App\Models\EduUsers::where('openid', $openid)->first();
        return is_null($modelEduUser) ? false : true;
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