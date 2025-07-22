<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --stop-when-empty --tries=3')->everyMinute();
Schedule::command('backup:clean')->daily()->at('03:00');
Schedule::command('backup:run')->daily()->at('03:30');
