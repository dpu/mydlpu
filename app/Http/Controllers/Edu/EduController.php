<?php

namespace App\Http\Controllers\Edu;

use App\Http\Controllers\Controller;
use App\Services\Edu\EduService;
use Illuminate\Http\Request;

class EduController extends Controller
{
    public function bindingHtml()
    {
        $app = app('wechat');
        $user = $app->oauth->user();
        $openid = $user->id;

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
        $user = $app->oauth->user();
        $openid = $user->id;

        $data = (new EduService)->removeBinding($openid);

        return view('edu.binding.result')->with('data', $data);
    }

}