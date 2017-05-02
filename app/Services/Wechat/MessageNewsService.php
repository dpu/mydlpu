<?php

namespace App\Services\Wechat;

use App\Services\Service;

class MessageNewsService extends Service
{
    public function scoreLevel($scoresLevel)
    {
        if (!is_array($scoresLevel) || count($scoresLevel) <= 1) {
            return new \EasyWeChat\Message\News([
                'title' => "教务处没有你的数据哟~"
            ]);
        }

        unset($scoresLevel[0]);
        $news[] = new \EasyWeChat\Message\News([
            'title' => "教务处 » 我的成绩 » 课程成绩查询 "
        ]);
        foreach ($scoresLevel as $key => $item) {
            $score = $item[4] ?? $item[7];
            $news[] = new \EasyWeChat\Message\News([
                'title' => "$item[1]\n考试时间：$item[8]\t\t分数等级：$score"
            ]);
        }

        return $news;
    }
}
