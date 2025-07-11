<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('schedule:run', function () {
    $schedule = app(Schedule::class);

    // Chạy báo cáo hàng ngày lúc 01:00 sáng
    $schedule->command('report:summary')->dailyAt('01:00');

    // Backup database mỗi tuần
    $schedule->command('backup:database')->weekly();
});
