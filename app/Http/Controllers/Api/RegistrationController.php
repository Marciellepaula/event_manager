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

    public function subscribeToEvent(Request $request, $eventId)
    {
        $user = $request->user();

        $response = $this->eventSubscriptionService->subscribeToEvent($user, $eventId);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 400);
        }

        return response()->json(['success' => $response['success']], 200);
    }

    public function unsubscribeFromEvent(Request $request, $eventId)
    {
        $user = $request->user();

        $response = $this->eventSubscriptionService->unsubscribeFromEvent($user, $eventId);

        if (isset($response['success'])) {
            return response()->json(['success' => $response['success']], 200);
        }

        return response()->json(['error' => 'Erro desconhecido ao tentar se desinscrever.'], 500);
    }
}
