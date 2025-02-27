<?php

namespace App\Services;

use App\Jobs\SendEventSubscriptionEmail;
use App\Models\Event;
use App\Models\Registration;
use App\Jobs\SendEventUnsubscribedEmail;
use App\Jobs\SendEventUnsubscriptionEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventSubscriptionService
{
    public function subscribeToEvent($eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);



        if ($registrationCount = Registration::where('event_id', $event->id)->count() >= $event->max_capacity || $event->status !== 'open') {
            return ['error' => 'Capacidade máxima atingida ou o evento não está mais aberto.'];
        }


        if ($user->registrations()->where('event_id', $eventId)->exists()) {
            return ['error' => 'Você já está inscrito neste evento.'];
        }

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        try {

            SendEventSubscriptionEmail::dispatch($user, $event);
        } catch (\Exception $e) {
            Log::error('Error dispatching subscription email: ' . $e->getMessage());
        }

        return ['success' => 'Inscrição realizada com sucesso!'];
    }


    public function unsubscribeFromEvent($eventId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventId);

        $registration = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$registration) {
            return ['error' => 'Inscrição não encontrada.'];
        }

        $registration->delete();


        try {
            SendEventUnsubscriptionEmail::dispatch($user, $event);
        } catch (\Exception $e) {

            Log::error('Error dispatching unsubscribe email: ' . $e->getMessage());
        }

        return ['success' => 'Inscrição cancelada com sucesso!'];
    }
}
