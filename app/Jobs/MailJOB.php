<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\iMail;


class MailJOB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $msgdata;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msgdata)
    {
        $this->msgdata = $msgdata;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $email = new iMail($this->msgdata);

        $managers = User::where("role", "=", 1);
        foreach ($managers as $man) {
            Mail::to($man->email)->send($email);
        }
    }
}
