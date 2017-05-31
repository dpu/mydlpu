<?php

namespace App\Console;

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
        \App\Console\Commands\ExpressTracking::class,
        \App\Console\Commands\EduNewsListUpdate::class,
        \App\Console\Commands\EduTimetableUpdate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('express:tracking')->name('express')->withoutOverlapping()->everyTenMinutes()->appendOutputTo(storage_path('logs/schedule_express.log'));

        $schedule->command('edu:news')->name('news')->withoutOverlapping()->everyThirtyMinutes()->appendOutputTo(storage_path('logs/schedule_edu_news.log'));

        $schedule->command('edu:timetable')->name('timetable')->withoutOverlapping()->cron('5 5 * * 1')->appendOutputTo(storage_path('logs/schedule_edu_timetable.log'));
    }
}
