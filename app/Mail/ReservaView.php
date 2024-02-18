<?php

namespace App\Mail;

use App\Models\Reserva;
use App\Models\Reservasoout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaView extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;
    /**
     * Create a new message instance.
     */
    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reserva confirm')
            ->view('emails.reserva', ['reserva' => $this->reserva]); // Assuming you have a 'reserva.blade.php' file in 'resources/views/emails'
    }
}
