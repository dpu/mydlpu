<?php

namespace App\Listeners;

use App\Events\ExpressEvent;
use App\Services\LogService;
use App\Services\Wechat\MessageNoticeService;
use Cn\Xu42\ExpressTracking\Service\ExpressTrackingService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpressListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(ExpressEvent $event)
    {
        $id = $event->express->id;
        $postId = $event->express->nu;
        $comCodes = [0 => $event->express->com];
        $state = $event->express->state;
        $openid = $event->express->openid;
        $note = $event->express->note;
        $time = strtotime($event->express->time);

        $service = new ExpressTrackingService;

        while ($state != 3) {
            LogService::express('进入while开始处理...', [$state, $time]);
            try {
                $data = $service->query($postId, $comCodes);
                LogService::express('ExpressService query Success ...', [$openid, $data]);
            } catch (\Throwable $throwable) {
                LogService::express('ExpressService query Error ...', [$openid, $throwable->getMessage(), $throwable->getTrace()]);
            }

            if (strtotime($data['data'][0]['time']) <= $time) {
                LogService::express('睡眠...', [$state, strtotime($data['data'][0]['time']), $time]);
                sleep(6);
            }
            if (strtotime($data['data'][0]['time']) > $time) {
                LogService::express('命中...', [$state, strtotime($data['data'][0]['time']), $time]);
                $remark = "\n您将实时收到快递最新状态!\n备注：$note" . ' [' . $event->express->com . ']';
                MessageNoticeService::express($openid, '快递有新动态啦', $postId, $data['data'][0]['context'], $data['data'][0]['time'], $remark, $data['url']);
                $this->updateToDB($id, $data['state'], $data['data'][0]['time'], $data['data'][0]['context'], $data['message']);
            }

            $state = $data['state'];
            $time = strtotime($data['data'][0]['time']);
            LogService::express('while最后处理...', [$state, $time]);
        }
        LogService::express('while结束...', [$state, $time]);
        return;
    }


    private function updateToDB($id, $state, $time, $context, $message)
    {
        $modelExpress = \App\Models\Express::where('id', $id)->first();
        $modelExpress->state = $state;
        $modelExpress->context = $context;
        $modelExpress->time = $time;
        $modelExpress->message = $message;
        $modelExpress->save();
        return $modelExpress;
    }

}
