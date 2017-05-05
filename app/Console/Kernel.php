<?php

namespace App\Console;

use App\Services\Express\ExpressService;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $modelExpress = \App\Models\Express::where('state', '!=', 3)->orderBy('created_at')->get();
            foreach ($modelExpress as $model) {
                (new ExpressService)->doSchedule($model->id, $model->time, $model->openid, $model->nu, $model->com, $model->note);
            }
        })->name('express')->everyTenMinutes();
    }
}
