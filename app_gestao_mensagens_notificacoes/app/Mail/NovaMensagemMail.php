<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaMensagemMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // route to show message
        $url = route('mensagens.show', $this->mensagem->id);
        return $this->markdown('emails.nova-mensagem')
            ->subject('Nova mensagem')
            ->with([
                'mensagem' => $this->mensagem,
                'url' => $url
            ]);
    }
}
