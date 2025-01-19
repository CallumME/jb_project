<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DispatchTest;

class DispatchTestCommand extends Command
{
    // The name and signature of the console command
    protected $signature = 'dispatch:test-job {userId}';

    // The console command description
    protected $description = 'Dispatch a test job for the specified user ID';

    // Execute the console command
    public function handle()
    {
        // Get the user ID argument passed to the command
        $userId = $this->argument('userId');

        // Dispatch the job
        DispatchTest::dispatch($userId);

        // Inform the user that the job was dispatched
        $this->info("Test job dispatched for user ID: $userId");
    }
}
