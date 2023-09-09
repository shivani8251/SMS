<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendGrid extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_code = $this->input['order_code'];
        $name = $this->input['name'];
        return $this->subject('ECOM - Order Invoice')
            ->from('bhavesh.programmics@gmail.com', 'ECOM - Order Invoice')
            ->view('emails.order_bill', ['order_code' => $order_code, 'name' => $name])
            ->attach($this->input['file']);
        
    }
}
