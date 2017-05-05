<?php

namespace App\Services\Mina;

use App\Services\Edu\EduService;

class MinaService
{

    public function timetable($username, $password, $semester, $week)
    {
        $openid = '';
        $mobile = '';

        $eduService = new EduService();
        $token = $eduService->getToken($username, $password);
        $this->removeFromDBByUsername($username);
        $this->recordToDB($openid, $username, $password, $mobile);
        $timetable = @$eduService->getTimetable($token, $semester, $week);
        return $timetable;
    }

    public function currentTime()
    {
        $eduService = new EduService();
        $currentWeek = $eduService->getCurrentWeek();
        $currentSemester = config('edu.semester');
        return ['semester' => $currentSemester, 'week' => $currentWeek];
    }

    public function feedback($content)
    {
        if (!empty($content)) {
            $modelFeedback = new \App\Models\Feedback;
            $modelFeedback->content = $content;
            $modelFeedback->from = 'mina';
            $modelFeedback->save();
        }
        return true;
    }

    public function rowByOpenid($openid)
    {
        return \App\Models\EduUsers::where('openid', $openid)->first();
    }

    private function recordToDB($openid, $username, $password, $mobile)
    {
        $modelEduUser = new \App\Models\MinaUsers;
        $modelEduUser->openid = $openid;
        $modelEduUser->username = $username;
        $modelEduUser->password = $password;
        $modelEduUser->mobile = $mobile;
        $modelEduUser->save();
        return $modelEduUser;
    }

    private function removeFromDBByUsername($username)
    {
        $modelEduUser = \App\Models\MinaUsers::where('username', $username)->delete();
        return is_null($modelEduUser) ? false : true;
    }


}