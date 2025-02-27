<?php

namespace App\Services;

use App\Jobs\SendEventSubscriptionEmail;
use App\Models\Event;
use App\Models\Registration;
use App\Jobs\SendEventUnsubscriptionEmail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EventSubscriptionService
{
    public function subscribeToEvent(User $user, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $registrationCount = Registration::where('event_id', $event->id)->count();
        if ($registrationCount >= $event->max_capacity || $event->status !== 'open') {
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
            SendEventSubscriptionEmail::dispatch($user->id, $event->id);
        } catch (\Exception $e) {
            Log::error('Erro ao enfileirar o e-mail de inscrição: ' . $e->getMessage());
        }

        return ['success' => 'Inscrição realizada com sucesso!'];
    }


    public function getAllEventsOpen()
    {

        return  Event::where('status', '=', 'open')->paginate(10);
    }



    public function unsubscribeFromEvent(User $user, $eventId)
    {

        $event = Event::findOrFail($eventId);

        $registration = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$registration) {
            return ['error' => 'Inscrição não encontrada.'];
        }

        $registration->delete();


        try {
            SendEventUnsubscriptionEmail::dispatch($user->id, $event->id);
        } catch (\Exception $e) {

            Log::error('Error dispatching unsubscribe email: ' . $e->getMessage());
        }

        return ['success' => 'Inscrição cancelada com sucesso!'];
    }
}
