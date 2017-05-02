<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Services\Edu\EduService;
use App\Services\LogService;
use App\Services\Wechat\MessageNewsService;
use App\Services\Wechat\MessageTextService;

class MessageEventClickController extends Controller
{
    public function handle($message, $app)
    {
        switch ($message->EventKey) {
            case config('wechat.button.score_level'):
                return $this->scoreLevel($message, $app);
                break;
            case config('wechat.button.timetable'):
                return $this->timetable($message, $app);
                break;
            default :
                return 'ing';
                break;
        }

    }


    private function scoreLevel($message, $app)
    {
        $openid = $message->FromUserName;
        $app->staff->message(MessageTextService::ing())->to($openid)->send();
        $eduService = new EduService();
        try {
            $modelUser = $eduService->rowByOpenid($openid);
            $token = $eduService->getToken($modelUser->username, $modelUser->password);
            $scoresLevel = $eduService->getLevelScores($token);
            $news = (new MessageNewsService)->scoreLevel($scoresLevel);
        } catch (\Throwable $t) {
            LogService::edu('Edu scoreLevel error...', [$openid, $t->getMessage(), $t->getTrace()]);
            $news = MessageTextService::simple($t->getMessage());
        }

        $app->staff->message($news)->to($openid)->send();
    }

    private function timetable($message, $app)
    {
        $openid = $message->FromUserName;
        $app->staff->message(MessageTextService::ing())->to($openid)->send();
        $eduService = new EduService();
        try {
            $modelUser = $eduService->rowByOpenid($openid);
            $token = $eduService->getToken($modelUser->username, $modelUser->password);
            $semester = config('edu.semester');
            $week = $eduService->getCurrentWeek();
            $timetable = @$eduService->getTimetable($token, $semester, $week);
            $news = (new MessageNewsService)->timetable($timetable);
        } catch (\Throwable $t) {
            LogService::edu('Edu timetable error...', [$openid, $t->getMessage(), $t->getTrace()]);
            $news = MessageTextService::simple($t->getMessage());
        }

        $app->staff->message($news)->to($openid)->send();
    }

}
