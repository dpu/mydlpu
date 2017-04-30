<?php

namespace App\Http\Controllers\Express;

use App\Http\Controllers\Controller;
use App\Services\Express\ExpressService;
use Illuminate\Http\Request;

class ExpressController extends Controller
{
    public function indexHtml()
    {
        $app = app('wechat');
        $user = $app->oauth->user();
        $openid = $user->id;

        return view('express.index')->with('openid', $openid);
    }

    public function resultHtml(Request $request)
    {
        $openid = $request->get('openid');
        $postId = $request->get('nu');
        $note = $request->get('note');

        $data = (new ExpressService)->doTracking($openid, $postId, $note);

        return view('express.result')->with('data', $data);
    }
}