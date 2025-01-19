<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DispatchTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;

    // Constructor for the job
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    // Handle the job
    public function handle()
    {
        $user = User::find($this->userId);


        if ($user) {

            Mail::to($user->email)->queue(new WelcomeEmail($user));
        }
    }
}
