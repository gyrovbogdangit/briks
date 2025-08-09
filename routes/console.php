<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --stop-when-empty --tries=3')->everyMinute();
