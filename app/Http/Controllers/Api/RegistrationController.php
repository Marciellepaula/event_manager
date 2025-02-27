<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventSubscriptionService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    protected $eventSubscriptionService;

    public function __construct(EventSubscriptionService $eventSubscriptionService)
    {
        $this->eventSubscriptionService = $eventSubscriptionService;
    }

    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function subscribeToEvent($eventId)
    {
        $response = $this->eventSubscriptionService->subscribeToEvent($eventId);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 400);
        }

        if (isset($response['success'])) {
            return response()->json(['success' => $response['success']], 200);
        }

        return response()->json(['error' => 'Erro desconhecido ao tentar se inscrever.'], 500);
    }

    public function unsubscribeFromEvent($eventId)
    {
        $response = $this->eventSubscriptionService->unsubscribeFromEvent($eventId);

        if (isset($response['success'])) {
            return response()->json(['success' => $response['success']], 200);
        }

        return response()->json(['error' => 'Erro desconhecido ao tentar se desinscrever.'], 500);
    }
}
