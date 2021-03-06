<?php

namespace App\Services\Edu;

use App\Services\LogService;
use Cn\Xu42\Qznjw2014\Account\Service\AccountService;
use Cn\Xu42\Qznjw2014\Education\Service\EducationService;

class EduService
{

    public function binding($openid, $username, $password, $mobile = '')
    {
        $this->removeFromDB($openid);

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
        if ($this->rowByOpenid($openid)) {
            $removeRes = $this->removeFromDB($openid);
            LogService::edu('Edu removeBinding success...', [$openid]);
            return ['icon' => 'success', 'title' => config('paper.edu.binding.remove_success')];
        }
        LogService::edu('Edu removeBinding error...', [$openid]);
        return ['icon' => 'warn', 'title' => config('paper.edu.binding.have_no')];
    }


    public function rowByOpenid($openid)
    {
        return \App\Models\EduUsers::where('openid', $openid)->first();
    }

    public function getToken($username, $password)
    {
        return (new AccountService)->getToken($username, $password);
    }

    public function getCoursesScores($token, $semester = '')
    {
        return (new EducationService)->getCoursesScores($token, $semester);
    }

    public function getTimetable($token, $semester, $week = '')
    {
        return (new EducationService)->getTimetable($token, $semester, $week);
    }

    public function getCurrentWeek()
    {
        return (new EducationService)->getCurrentWeek();
    }

    public function getLevelScores($token)
    {
        return (new EducationService)->getLevelScores($token);
    }

    public function getExamsInfo($token, $semester)
    {
        return (new EducationService)->getExamInfo($token, $semester);
    }

    private function recordToDB($openid, $username, $password, $mobile)
    {
        $this->removeFromDB($openid);
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