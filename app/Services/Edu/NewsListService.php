<?php

namespace App\Services\Edu;

class NewsListService
{
    public function currentEvents()
    {
        return \App\Models\News::where('type', config('edu.current_events', '新闻动态'))->get()->toArray();
    }

    public function notice()
    {
        return \App\Models\News::where('type', config('edu.notice', '通知公告'))->get()->toArray();
    }

    public function teachingFiles()
    {
        return \App\Models\News::where('type', config('edu.teaching_files', '教务文件'))->get()->toArray();
    }

}