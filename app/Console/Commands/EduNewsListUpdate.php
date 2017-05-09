<?php

namespace App\Console\Commands;

use App\Services\LogService;
use Cn\Xu42\DlpuNews\DlpuNews;
use Illuminate\Console\Command;


class EduNewsListUpdate extends Command
{
    protected $signature = 'edu:news';

    protected $description = 'Edu news list auto update...';

    public function handle()
    {
        $newsService = new DlpuNews();
        try {
            $this->save(config('edu.current_events'), $newsService->currentEvents());
            $this->save(config('edu.notice'), $newsService->notice());
            $this->save(config('edu.teaching_files'), $newsService->teachingFiles());
        } catch (\Throwable $t) {
            LogService::edu('EduNewsListUpdate handle error...', [$t->getMessage(), $t->getTrace()]);
        }
    }

    private function save($type, $list)
    {
        $this->deleteByType($type);
        foreach ($list as $item) {
            $modelNews = new \App\Models\News;
            $modelNews->type = $type;
            $modelNews->title = $item['title'];
            $modelNews->url = $item['url'];
            $modelNews->time = $item['time'];
            $modelNews->save();
        }
        return true;
    }

    private function deleteByType($type)
    {
        return \App\Models\News::where('type', $type)->delete();
    }

}