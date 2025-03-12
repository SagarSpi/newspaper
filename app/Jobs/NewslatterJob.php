<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NewslatterJob implements ShouldQueue
{
    use Queueable;
    public $email;

    /**
     * Create a new job instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send( new NewsletterMail());
    }
}
