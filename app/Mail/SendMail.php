<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $view = $this->data['view'];
        return $this->from('noreply@xseries360.com', 'Xseries Support Team')
                    ->subject($this->data['subject'])
                    ->view("email.$view")
                    ->with($this->data);
    }
}
