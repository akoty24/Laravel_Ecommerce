<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorContact extends Mailable
{
    use Queueable, SerializesModels;
public $validatedData ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validatedData)
    {
        $this->validatedData=$validatedData;
    }
    public function build(){
        return $this->markdown('front.contactmail');
   //return $this->subject('Contant Message')->view('front.contactmail');
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

}
