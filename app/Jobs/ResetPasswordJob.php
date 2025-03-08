<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMaill;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ResetPasswordJob implements ShouldQueue
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
        Mail::to($this->request->email)->send( new ResetPasswordMaill($this->request));
    }
}
