<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;
    public $password;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataEmail)
    {
        $this->user = $dataEmail['user'];
        $this->password = $dataEmail['password'];
        $this->booking = $dataEmail['booking'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Status Booking Anda')
                    ->view('Email.bookingStatus')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                        'booking' => $this->booking,
                    ]);
    }
}
