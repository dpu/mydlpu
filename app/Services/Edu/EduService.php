<?php

namespace App\Services\Edu;

use App\Services\LogService;
use Cn\Xu42\Qznjw2014\Account\Service\AccountService;

class EduService
{

    public function binding($openid, $username, $password, $mobile = '')
    {
        try {
            $token = (new AccountService)->getToken($username, $password);
        } catch (\Throwable $t) {
            LogService::edu('Edu getToken Error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'desc' => $t->getMessage()];
        }

        if ($this->isBinding($openid, $username)) {
            return ['icon' => 'info', 'desc' => config('paper.edu.binding.already')];
        }

        try {
            $this->recordToDB($openid, $username, $password, $mobile);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.success')];
        } catch (\Throwable $t) {
            LogService::edu('Edu recordToDB error...', [$openid, $username, $password, $t->getMessage(), $t->getTrace()]);
            return ['icon' => 'warn', 'title' => config('paper.edu.binding.error')];
        }
    }


    private function isBinding($openid, $username)
    {
        $modelEduUser = \App\Models\EduUsers::where('openid', $openid)->where('username', $username)->first();
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


}