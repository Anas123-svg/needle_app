<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $calendar_date;

    public function __construct($calendar_date)
    {
        $this->calendar_date = $calendar_date;
    }

    public function build()
    {
        return $this->subject('Your Appointment Details')
                    ->view('emails.book_appointment');
    }
}
