<?php

namespace App\Http\Controllers\Cet;

use App\Http\Controllers\Controller;
use Cn\Xu42\Cet\Service\CetService;
use Illuminate\Http\Request;

class CetController extends Controller
{
    public function indexHtml()
    {
        return view('cet.index')->with('jsconfig', $this->shareConfig());
    }

    public function resultHtml(Request $request)
    {
        $name = $request->get('name');
        $number = $request->get('number');

        try {
            $cetScores = (new CetService)->query($name, $number);
        } catch (\Throwable $t) {
            $cetScores = null;
        }

        return view('cet.result')->with('score', $cetScores)->with('jsconfig', $this->shareConfig());
    }


    private function shareConfig()
    {
        $app = app('wechat');
        return $app->js->config([
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareQZone'
        ], true);
    }
}
