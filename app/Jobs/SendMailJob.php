<?php

namespace App\Jobs;

use App\Mail\UserReportMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccesFullMail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailJob implements ShouldQueue
{
    use Queueable;
    public $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->request->email)->send(new RegistrationSuccesFullMail($this->request));
        Mail::to('sagarspi583@gmail.com')->send(new UserReportMail);
    }
}
