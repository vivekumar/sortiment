<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!empty($this->order["pdf"])){
            return $this->view('mail.payment-received')->subject('Hent din faktura på din konto')->attach(public_path($this->order["pdf"]));
        }else{
            return $this->view('mail.payment-received')->subject('Hent din faktura på din konto');
        }
        
    }
}
