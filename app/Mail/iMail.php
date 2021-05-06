<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class iMail extends Mailable
{
    use Queueable, SerializesModels;
    public $msgdata ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msgdata)
    {
        $this->msgdata=$msgdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('blocks.mail')->subject("Сообщение по обратной связи от ".$this->msgdata->email)->with("maildata",$this->msgdata);
    }
}
