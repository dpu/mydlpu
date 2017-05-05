<?php

namespace App\Http\Controllers\Net;

use App\Http\Controllers\Controller;
use App\Services\NetWork\NetworkService;
use Illuminate\Http\Request;
use Overtrue\Socialite\AuthorizeFailedException;

class NetController extends Controller
{

    public function bindingHtml()
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return redirect(config('wechat.url.prefix') . urlencode(route('netBinding')) . config('wechat.url.suffix_base'));
        }

        return view('net.binding.index')->with('openid', $openid);
    }

    public function bindingResultHtml(Request $request)
    {
        $openid = $request->input('openid');
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $data = (new NetworkService)->binding($openid, $username, $password, $mobile);

        return view('net.binding.result')->with('data', $data);
    }

    public function removeBindingHtml()
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return redirect(config('wechat.url.prefix') . urlencode(route('netBindingRemove')) . config('wechat.url.suffix_base'));
        }

        $data = (new NetworkService)->removeBinding($openid);

        return view('net.binding.result')->with('data', $data);
    }

}