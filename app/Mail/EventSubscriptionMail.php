<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventSubscriptionMail extends Mailable implements ShouldQueue
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

        $user = User::findOrFail($this->userId);
        $event = Event::findOrFail($this->eventId);

        return $this->subject('Inscrição no Evento')
            ->markdown('emails.event_subscribed')
            ->with([
                'userName' => $user->name,
                'eventTitle' => $event->title,
            ]);
    }
}
