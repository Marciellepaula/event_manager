<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventUnsubscriptionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $event;
    public $user;

    public function __construct(User $user, Event $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cancelamento de Inscrição no Evento',
        );
    }

    public function build()
    {
        return $this->view('emails.event_unsubscribed')
            ->subject('Cancelamento de Inscrição')
            ->with([
                'userName' => $this->user->name,
                'eventTitle' => $this->event->title,
            ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
