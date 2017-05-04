<?php

return [
    'semester' => '2016-2017-1',
    'day_php' => date('N'), //1-7 周一-周日
    'day_edu' => date('N')-1, //0-6 周一-周日
    'current_events' => '新闻动态',
    'notice' => '通知公告',
    'teaching_files' => '教务文件',
    'url' => [
        'binding_edu' => config('wechat.url.prefix').urlencode(route('eduBinding')).config('wechat.url.suffix_base'),
        'binding_net' => config('wechat.url.prefix').urlencode(route('netBinding')).config('wechat.url.suffix_base'),
        'remove_binding' => config('wechat.url.prefix').urlencode(route('eduBindingRemove')).config('wechat.url.suffix_base'),
    ],
];