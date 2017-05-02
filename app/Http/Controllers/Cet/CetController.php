<?php

namespace App\Http\Controllers\Cet;

use App\Common\Config;
use App\Http\Controllers\Controller;
use App\Services\Cet\CetService;
use Illuminate\Http\Request;

class CetController extends Controller
{
    public function indexHtml()
    {
        return view('cet.index')->with('jsconfig', Config::wechatShareConfig());
    }

    public function resultHtml(Request $request)
    {
        $name = $request->get('name');
        $number = $request->get('number');
        $from = $request->get('from', 'unknow');

        try {
            $cetService = new CetService;
            if (!is_null($cetScoresDB = $cetService->rowFromDB($name, $number))) {
                $cetScores = json_decode($cetScoresDB->context, true);
            } else {
                $cetScores = $cetService->query($name, $number);
                $cetService->recordToDB($name, $number, $cetScores, $from);
            }
        } catch (\Throwable $t) {
            $cetScores = null;
        }

        return view('cet.result')->with('score', $cetScores)->with('jsconfig', Config::wechatShareConfig());
    }

}
