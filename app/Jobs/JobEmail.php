<?php

namespace App\Jobs;

use App\Mail\ApproveEmail;
use App\Notifications\ApproveNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class JobEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $email;
    public function __construct($email)
    {
        //
        $this->email=$email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        try{
       $email=$this->email;
       Notification::route('mail', $email)->notify(new ApproveNotification);
        }
        catch(\Exception $e){
          report($e);
        }
    }
}
