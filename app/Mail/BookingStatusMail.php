<?php

namespace App\Mail;

use App\Wahana;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $booking;
	public $wahana;

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
		$this->wahana = Wahana::where('id', $dataEmail['booking']['wahana_id'])->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Status booking Anda')
                    ->view('email.bookingStatus')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                        'booking' => $this->booking,
                    ]);
    }
}
