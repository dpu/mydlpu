<?php

namespace App\Services\Express;

use App\Events\ExpressEvent;
use App\Services\LogService;
use App\Services\Service;
use App\Services\Wechat\MessageNoticeService;
use Cn\Xu42\ExpressTracking\Service\ExpressTrackingService;

class ExpressService extends Service
{
    public function doTracking($openid, $postId, $note)
    {
        $service = new ExpressTrackingService;

        try {
            $data = $service->query($postId, $service->getComCodes($postId));
            LogService::express('ExpressService query Success ...', [$openid, $data]);
        } catch (\Throwable $throwable) {
            LogService::express('ExpressService query Error ...', [$openid, $throwable->getMessage(), $throwable->getTrace()]);
            return ['icon' => 'warn', 'title' => '查询服务出错', 'desc' => $throwable->getMessage()];
        }

        if ($data['status'] == 200 && $data['state'] == 3) {
            MessageNoticeService::express($openid, '快递最新动态: 已签收', $postId, $data['data'][0]['context'], $data['data'][0]['time'], '', $data['url']);
            $this->recordToDB($openid, $data, $note, '已签收');
            return ['icon' => 'success', 'title' => '已签收', 'desc' => ''];
        }

        if ($data['status'] == 200 && $data['state'] != 3) {
            $remark = "\n您将实时收到快递最新状态!\n备注：$note" . ' [' . $data['com'] . ']';
            MessageNoticeService::express($openid, '快递有新动态啦', $postId, $data['data'][0]['context'], $data['data'][0]['time'], $remark, $data['url']);
            $modelExpress = $this->recordToDB($openid, $data, $note, $remark);
            \event(new ExpressEvent($modelExpress));
            return ['icon' => 'success', 'title' => '已加入追踪服务', 'desc' => '请关闭页面 enjoy更多服务'];
        }

        return ['icon' => 'warn', 'title' => '未知错误', 'desc' => 'status:' . $data['status'] . 'state:' . $data['state']];
    }

    private function recordToDB($openid, $data, $note, $remark)
    {
        $modelExpress = new \App\Models\Express;

        $modelExpress->openid = $openid;
        $modelExpress->nu = $data['nu'];
        $modelExpress->state = $data['state'];
        $modelExpress->context = $data['data'][0]['context'];
        $modelExpress->time = $data['data'][0]['time'];
        $modelExpress->com = $data['com'];
        $modelExpress->message = $data['message'];
        $modelExpress->note = $note;
        $modelExpress->remark = $remark;
        $modelExpress->url = $data['url'];

        $modelExpress->save();
        return $modelExpress;
    }
}