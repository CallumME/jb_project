<?php

namespace App\Console;

use App\Console\Commands\DispatchTestJobCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        DispatchTestJobCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Define your scheduled commands here
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}