<?php

namespace App\Services\Cet;

use App\DTO\Cet\CetScoresDTO;
use App\Services\LogService;
use App\Services\Service;
use App\Services\Wechat\MessageNoticeService;
use App\Services\Wechat\MessageTextService;

class CetService extends Service
{
    public function get($openid, $content, $app)
    {
        $app->staff->message(MessageTextService::ing())->to($openid)->send();

        $from = 'command';
        $pregRes1 = preg_match('/([\x{4e00}-\x{9fa5}]+)/u', $content, $matchesName);
        $pregRes2 = preg_match('/(\d+)/', $content, $matchesNumber);

        $name = $matchesName[1];
        $number = $matchesNumber[1];
        if ($pregRes1 !== 1 || $pregRes2 !== 1) {
            $app->staff->message(MessageTextService::errorCetArgument())->to($openid)->send();
            return;
        }

        LogService::cet('CET query Start ...', [$openid, $name, $number]);
        try {
            if (!is_null($cetScoresDB = $this->rowFromDB($name, $number))) {
                $DTO = $this->arrayToDTO(json_decode($cetScoresDB->context, true));
            } else {
                $cetScores = $this->query($name, $number);
                $DTO = $this->arrayToDTO($cetScores);
                $this->recordToDB($name, $number, $cetScores, $from);
            }
            LogService::cet('CET query Success...', [$openid, $name, $number, json_encode($DTO)]);
        } catch (\Throwable $throwable) {
            $text = $throwable->getMessage() ? $throwable->getMessage() : config('paper.cet.error.system');
            LogService::cet('CET query Error...', [$openid, $name, $number, $throwable->getMessage(), $throwable->getTrace()]);
            $app->staff->message(MessageTextService::simple($text))->to($openid)->send();
            return;
        }

        $detail = sprintf("\n笔试:总分%s 听力%s 阅读%s 写作翻译%s\n口试:等级 %s\n",
            $DTO->written->score, $DTO->written->listening, $DTO->written->reading, $DTO->written->translation, $DTO->oral->score);
        $remark = ($DTO->written->score >= 425 || $DTO->oral->score == 'A') ? '恭喜你通过了四六级考试！' : '很遗憾，没有通过四六级考试';

        MessageNoticeService::cet($openid, $DTO->name, $DTO->school, $number, $detail, $remark);
    }

    public function arrayToDTO($cetScores)
    {
        $cetScoresDTO = new CetScoresDTO;
        $cetScoresDTO->name = $cetScores['name'] ?? '';
        $cetScoresDTO->school = $cetScores['school'] ?? '';
        $cetScoresDTO->type = $cetScores['type'] ?? '';
        $cetScoresDTO->written = new \App\DTO\Cet\CetScoresWrittenDTO;
        $cetScoresDTO->written->number = $cetScores['written']['number'] ?? '';
        $cetScoresDTO->written->score = $cetScores['written']['score'] ?? 0;
        $cetScoresDTO->written->listening = $cetScores['written']['listening'] ?? 0;
        $cetScoresDTO->written->reading = $cetScores['written']['reading'] ?? 0;
        $cetScoresDTO->written->translation = $cetScores['written']['translation'] ?? 0;
        $cetScoresDTO->oral = new \App\DTO\Cet\CetScoresOralDTO;
        $cetScoresDTO->oral->number = $cetScores['oral']['number'] ?? '';
        $cetScoresDTO->oral->score = $cetScores['oral']['score'] ?? '';

        return $cetScoresDTO;
    }

    public function query($name, $number)
    {
        return (new \Cn\Xu42\Cet\Service\CetService)->query($name, $number);
    }

    public function recordToDB($name, $number, $context, $from, $openid = '')
    {
        $modelCet = new \App\Models\Cet;
        $modelCet->name = $name;
        $modelCet->number = $number;
        $modelCet->context = json_encode($context);
        $modelCet->from = $from;
        $modelCet->openid = $openid;
        $modelCet->save();
        return $modelCet;
    }

    public function rowFromDB($name, $number)
    {
        return \App\Models\Cet::where('name', $name)->where('number', $number)->first();
    }
}
