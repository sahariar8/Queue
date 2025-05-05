<?php

namespace App\Jobs;

use App\Mail\AdminReportMail;
use App\Mail\RegistrationSuccessMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $latestUsers = User::latest()->take(5)->get();
        Mail::to($this->request->email)->send(new RegistrationSuccessMail($this->request));
        Mail::to('admin@gmail.com')->send(new AdminReportMail( $latestUsers));
    }
}
