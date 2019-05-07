<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class ReActivationNotifier extends Mailable
{
    use Queueable, SerializesModels;

    public $socio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $socio)
    {
        $this->socio = $socio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reActivation.mail')
            ->with([
                'socio_name'=>$this->socio->nome_informal,
                'socio_id'=>$this->socio->id
            ]);
    }
}
