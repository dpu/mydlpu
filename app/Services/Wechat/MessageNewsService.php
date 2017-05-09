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
                    "title" => sprintf("%-16s%s\n%s", "第 $section 大节", $item[0]['name'], $item[0]['room'])
                ]);
            }
        }

        return $news;
    }

    public static function news($sourceNews)
    {
        $news[] = new \EasyWeChat\Message\News([
            'title' => '教务处 » 新闻中心 » ' . $sourceNews[0]['type']
        ]);

        if (!is_array($sourceNews) || count($sourceNews) === 0) {
            $news[] = new \EasyWeChat\Message\News([
                'title' => "啊啊～没有获取到" . $sourceNews[0]['type']
            ]);
            return $news;
        }

        $sourceNews = array_slice($sourceNews, 0, 5);
        foreach ($sourceNews as $sourceNew) {
            $news[] = new \EasyWeChat\Message\News([
                'title' => $sourceNew['title'] . '[' . $sourceNew['time'] . ']',
                'url' => $sourceNew['url'],
            ]);
        }

        return $news;
    }

    public function eCard($balance, $consumption)
    {
        $name = $balance['name'] ?? '';
        $balanceBalance = $balance['balance'] ?? '未查询到';
        $consumptionRanking = $consumption['ranking'] ?? '未查询到';
        $consumptionConsumption = $consumption['consumption'] ?? '未查询到';

        $news[] = new \EasyWeChat\Message\News([
            'title' => '网络中心 » 一卡通 » ' . $name
        ]);
        $news[] = new \EasyWeChat\Message\News([
            'title' => sprintf("💰余额: %s 🔥消费: %s 📈排名: %s", $balanceBalance, $consumptionConsumption, $consumptionRanking),
        ]);

        return $news;
    }

    public function network($network)
    {
        $news[] = new \EasyWeChat\Message\News([
            'title' => '网络中心 » 自助服务 » 网络配置'
        ]);
        $news[] = new \EasyWeChat\Message\News([
            'title' => '💻IP: ' . $network['ip'],
        ]);
        $news[] = new \EasyWeChat\Message\News([
            'title' => 'MAC: ' . $network['mac'],
        ]);

        return $news;
    }
}
