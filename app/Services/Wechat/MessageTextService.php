<?php

namespace App\Services\Wechat;

use App\Services\Service;
use EasyWeChat\Message\Text;

class MessageTextService extends Service
{
    public static function simple($textContent = '')
    {
        return new Text(['content' =>  $textContent]);
    }

    public static function ing()
    {
        return new Text(['content' =>  '正在为您查询...']);
    }

    public static function serverWrong()
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "服务器开小差了 ==! ";
        return $text;
    }

    public static function register($message)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "=== 尚未绑定学号 ===\n\n回复: 绑定+学号+密码\n例: 绑定1305040301passwd";
        return $text;
    }

    public static function scoreGrade()
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "大学英语四六级成绩查询\n\n回复: cet+姓名+准考证号\n例: cet李白211070161201234";
        return $text;
    }

    public static function wrongCetQuery()
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "未查询到成绩\n可能尚未公布成绩或格式有误, 请按此格式回复以查询\n\ncet李白211070161201234";
        return $text;
    }

    public static function errorCetArgument()
    {
        return new Text(['content' =>  config('paper.cet.error.argument')]);
    }

    public static function wrongRegister()
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "学号或密码错误";
        return $text;
    }

    public static function express()
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "试用快递实时追踪服务\n\n回复: 快递+单号+备注\n例0: 快递1151302195208\n例1: 快递1151302195208阿里云发票\n例2: 快递 1151302195208 阿里云发票\n\n备注的第一个字若为数字,请在单号与备注之间添加空格";
        return $text;
    }

    public static function wrongExpress($url)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "您的快件未追踪到\n可能单号错误或刚发货\n\n" . '<a href="' . $url . '">【点此查看快件详情】</a>';
        return $text;
    }

    public static function receiptExpress($data, $url)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "您的快件已经是签收状态\n\n$data\n\n" . '<a href="' . $url . '">【点此查看快件详情】</a>';
        return $text;
    }


    public static function registerNetwork($message)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "=== 未绑定校园网自助 ===\n\n回复: 网络 学号 密码\n例: 网络 1305040301 passwd\n注：不要忘记是有空格的～";
        return $text;
    }

    public static function networkConfig($content)
    {
        $text = new \EasyWeChat\Message\Text;
        $text->content = "=== 校园网配置信息 ===\n\nIP：$content[0]\nMAC：$content[1]\n接入点：$content[3]\n类型：$content[4]\n";
        return $text;
    }

}
