<?php

namespace App\Services\Wechat;

use App\Services\Service;

class MessageNoticeService extends Service
{

    public static function cet($openid, $name, $school, $number, $detail, $remark, $url = '')
    {
        $templateId = 'jK_1ydRcPb1D6qQ9yfsZnjdJq_eLvMB71aO30YzD0M8';

        $data = [
            'first' => '',
            'keyword1' => $name,
            'keyword2' => $school,
            'keyword3' => $number,
            'keyword4' => $detail,
            'remark' => $remark
        ];

        return app('wechat')->notice->withTo($openid)->withUrl($url)->withTemplate($templateId)->withData($data)->send();
    }

    public static function express($openid, $first, $num, $context, $time, $remark = '', $url = '')
    {
        $templateId = 'l3SsVLLPPvVE4Zs26rzbuMj6ixFX3n9wzRAgPVCHGI0';

        $data = [
            'first' => $first,
            'keyword1' => $num,
            'keyword2' => $context,
            'keyword3' => $time,
            'remark' => [$remark, '#000']
        ];

        return app('wechat')->notice->withTo($openid)->withUrl($url)->withTemplate($templateId)->withData($data)->send();
    }

}