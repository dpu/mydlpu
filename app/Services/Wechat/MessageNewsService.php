<?php

namespace App\Services\Wechat;

use App\Services\Service;

class MessageNewsService extends Service
{
    public function scoreLevel($scoresLevel)
    {
        $news[] = new \EasyWeChat\Message\News([
            'title' => '教务处 » 我的成绩 » 等级考试成绩'
        ]);

        if (!is_array($scoresLevel) || count($scoresLevel) <= 1) {
            $news[] = new \EasyWeChat\Message\News([
                'title' => '教务处没有你的数据哟~'
            ]);
            return $news;
        }

        unset($scoresLevel[0]);
        foreach ($scoresLevel as $key => $item) {
            $score = $item[4] ?? $item[7];
            $news[] = new \EasyWeChat\Message\News([
                'title' => "$item[1]\n考试时间：$item[8]\t\t分数等级：$score"
            ]);
        }

        return $news;
    }

    public function timetable($timetable)
    {
        $news[] = new \EasyWeChat\Message\News([
            'title' => '教务处 » 我的课表 » 今天课表'
        ]);

        if (!is_array($timetable) || count($timetable) === 0) {
            $news[] = new \EasyWeChat\Message\News([
                'title' => "哎呀～竟然没课"
            ]);
            return $news;
        }

        foreach ($timetable as $day => $today) {
            if ($day != config('edu.day_edu')) continue;
            foreach ($today as $section => $item) {
                $section += 1;
                $news[] = new \EasyWeChat\Message\News([
                    "title" => sprintf("%-16s%s\n%-17s%s", "第[$section]大节", $item[0][2], $item[0][3], $item[0][0])
                ]);
            }
        }

        return $news;
    }
}
