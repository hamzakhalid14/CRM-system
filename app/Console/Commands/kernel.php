<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('crm:send-follow-up-reminders')->daily();
    }
    protected $routeMiddleware = [
        // ...
        'role' => \App\Http\Middleware\CheckRole::class,
    ];
}