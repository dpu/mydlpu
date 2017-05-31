<?php

namespace App\Services\Weather;

use App\Services\LogService;
use App\Services\Service;
use App\Services\Wechat\MessageNoticeService;

class WeatherService extends Service
{
    public function get($cityname)
    {
        $key = '6185e1a07642919c90560ddc957a6963';
        $dtype = 'json';

        $url = "https://op.juhe.cn/onebox/weather/query?key=$key&dtype=$dtype&cityname=$cityname";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $webPage = curl_exec($ch);
        curl_close($ch);
        return json_decode($webPage, true);
    }
}