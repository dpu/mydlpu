<?php

namespace App\Http\Controllers\Edu;

use App\Common\Config;
use App\Http\Controllers\Controller;
use App\Services\Edu\EduService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Overtrue\Socialite\AuthorizeFailedException;

class EduController extends Controller
{
    public function bindingHtml()
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return redirect(config('wechat.url.prefix') . urlencode(route('eduBinding')) . config('wechat.url.suffix_base'));
        }

        return view('edu.binding.index')->with('openid', $openid);
    }

    public function bindingResultHtml(Request $request)
    {
        $openid = $request->input('openid');
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $data = (new EduService)->binding($openid, $username, $password, $mobile);

        return view('edu.binding.result')->with('data', $data);
    }

    public function removeBindingHtml()
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return redirect(config('wechat.url.prefix') . urlencode(route('eduBindingRemove')) . config('wechat.url.suffix_base'));
        }

        $data = (new EduService)->removeBinding($openid);

        return view('edu.binding.result')->with('data', $data);
    }

    public function scoresCoursesHtml(Request $request)
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return view('error.only_wechat_browser');
        }

        $semester = $request->input('semester', '');

        $eduService = new EduService();

        try {
            $modelUser = $eduService->rowByOpenid($openid);
            if (is_null($modelUser)) return view('edu.binding.index')->with('openid', $openid);
            $token = $eduService->getToken($modelUser->username, $modelUser->password);
            $scores = $eduService->getCoursesScores($token, $semester);
            $data = ['semester' => $semester, 'title' => '我的期末成绩单', 'scores' => $scores];
        } catch (\Throwable $t) {
            $data = ['semester' => $semester, 'title' => '', 'scores' => []];;
            LogService::edu('Edu scoresCoursesHtml error...', [$openid, $modelUser]);
        }

        return view('edu.scores.courses')->with('data', $data)->with('jsconfig', Config::wechatShareConfig());
    }

    public function apiMinaTimetable(Request $request)
    {
        try {
            $eduService = new EduService();

            $username = $request->input('stuid');
            $password = $request->input('stupwd');
            $semester = $request->input('semester', config('edu.semester'));
            $week = $request->input('week', '');
            $token = $eduService->getToken($username, $password);
            $timetable = @$eduService->getTimetable($token, $semester, $week);
            return response()->json($timetable)->setCallback($request->input('callback'));
        } catch (\Throwable $t) {
            return response()->json(['errmsg' => $t->getMessage()])->setCallback($request->input('callback'));
        }
    }

}