<?php

namespace App\Jobs;

use App\Mail\EventUnsubscriptionMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEventUnsubscriptionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $userId;
    public int $eventId;

    public function __construct(int $userId, int $eventId)
    {
        $this->userId = $userId;
        $this->eventId = $eventId;
    }

    public function handle()
    {
        Mail::to(User::find($this->userId)?->email)
            ->send(new EventUnsubscriptionMail($this->userId, $this->eventId));
    }
}
