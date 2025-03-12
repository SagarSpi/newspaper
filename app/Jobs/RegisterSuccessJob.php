<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccesFullMail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterSuccessJob implements ShouldQueue
{
    use Queueable;
    public $name;
    public $email;

    /**
     * Create a new job instance.
     */
    public function __construct($name,$email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send( new RegistrationSuccesFullMail($this->name));
    }
}
