<?php

namespace App\Console\Commands;

use App\Services\Express\ExpressService;
use Illuminate\Console\Command;


class ExpressTracking extends Command
{
    protected $signature = 'express:tracking';

    protected $description = 'Tracking express ...';

    public function handle()
    {
        $modelExpress = \App\Models\Express::where('state', '!=', 3)->orderBy('created_at')->get();
        foreach ($modelExpress as $model) {
            (new ExpressService)->doSchedule($model->id, $model->time, $model->openid, $model->nu, $model->com, $model->note);
        }
    }

}