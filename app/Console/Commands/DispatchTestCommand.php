<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DispatchTest;

class DispatchTestCommand extends Command
{
    protected $signature = 'dispatch:test-job {userId}';

    protected $description = 'Dispatch a test job for the specified user ID';

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
