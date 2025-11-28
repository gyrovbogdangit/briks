<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --stop-when-empty --tries=3')->everyMinute();
Schedule::command('app:generate-sitemap')->cron('0 3 */3 * *')
    ->withoutOverlapping()
    ->sendOutputTo(storage_path('logs/sitemap.log'));

Schedule::command('app:generate-yml-catalog')->weekly();
