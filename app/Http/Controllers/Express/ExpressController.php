<?php

namespace App\Http\Controllers\Express;

use App\Common\Config;
use App\Http\Controllers\Controller;
use App\Services\Express\ExpressService;
use Illuminate\Http\Request;
use Overtrue\Socialite\AuthorizeFailedException;

class ExpressController extends Controller
{
    public function indexHtml()
    {
        $app = app('wechat');

        try {
            $openid = $app->oauth->user()->id;
        } catch (AuthorizeFailedException $e) {
            return redirect(config('wechat.url.prefix') . urlencode(route('express')) . config('wechat.url.suffix_base'));
        }

        return view('express.index')->with('openid', $openid)->with('jsconfig', Config::wechatShareConfig());
    }

    public function resultHtml(Request $request)
    {
        $openid = $request->get('openid');
        $postId = $request->get('nu');
        $note = $request->get('note');

        $data = (new ExpressService)->doTracking($openid, $postId, $note);

        return view('express.result')->with('data', $data)->with('jsconfig', Config::wechatShareConfig());
    }
}
