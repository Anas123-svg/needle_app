<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TattooSessionDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $timer, $invoice, $notes;

    public function __construct($timer, $invoice, $notes)
    {
        $this->timer = $timer;
        $this->invoice = $invoice;
        $this->notes = $notes;
    }

    public function build()
    {
        return $this->subject('Your Tattoo Session Details')
                    ->view('emails.tattoo_session');
    }
}
