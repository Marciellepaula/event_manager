<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventUnsubscriptionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $userId;
    public int $eventId;

    public function __construct(int $userId, int $eventId)
    {
        $this->userId = $userId;
        $this->eventId = $eventId;
    }

    public function build()
    {
        $user = User::find($this->userId);
        $event = Event::find($this->eventId);

        if (!$user || !$event) {
            return $this;
        }

        return $this->subject('Cancelamento de Inscrição')
            ->markdown('emails.event_unsubscribed')
            ->with([
                'userName' => $user->name,
                'eventTitle' => $event->title,
            ]);
    }
}
