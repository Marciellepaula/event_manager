<?php

namespace App\Jobs;

use App\Mail\EventSubscriptionMail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;



class SendEventSubscriptionEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $event;
    public $user;

    public function __construct(User $user, Event $event,)
    {
        $this->event = $event;
        $this->user = $user;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new EventSubscriptionMail($this->user, $this->event));
    }
}
