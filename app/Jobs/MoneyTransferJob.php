<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MoneyTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $amount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       if($this->amount >100){
         throw new \Exception("Amount is too high");
       }
       echo "Money transfer of {$this->amount} is successful!";
    }

    public function failed($exception)
    {
        $amount = $this->amount;

        Mail::send([], [], function ($msg) use ($exception, $amount) {
            $msg->to('sahariaralam8@gmail.com')
                ->subject("Money Transfer Failed")
                ->setBody("The money transfer of {$amount} failed due to: {$exception->getMessage()}", 'text/html');
                
        });
    }
}
