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

    public $day, $month,$year;

    public function __construct($day,$month,$year)
    {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    public function build()
    {
        return $this->subject('Your Appointment Details')
                    ->view('emails.book_appointment');
    }
}
