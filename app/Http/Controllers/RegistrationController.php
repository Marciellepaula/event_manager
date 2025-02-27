<?php

namespace App\Http\Controllers;

use App\Services\EventSubscriptionService;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    protected $eventSubscriptionService;

    public function __construct(EventSubscriptionService $eventSubscriptionService)
    {
        $this->eventSubscriptionService = $eventSubscriptionService;
    }

    public function index()
    {
        $events = $this->eventSubscriptionService->getAllEventsOpen();

        return view('participant.index', compact('events'));
    }


    public function subscribeToEvent($eventId)
    {

        $user = Auth::user();
        $response = $this->eventSubscriptionService->subscribeToEvent($eventId, $user);


        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        }

        if (isset($response['success'])) {
            return redirect()->back()->with('success', $response['success']);
        }


        return redirect()->back()->with('error', 'Erro desconhecido ao tentar inscrever.');
    }



    public function unsubscribeFromEvent($eventId)
    {

        $user = Auth::user();
        $response = $this->eventSubscriptionService->unsubscribeFromEvent($eventId, $user);
        if (isset($response['success'])) {
            return redirect()->back()->with('success', $response['success']);
        }

        return redirect()->back()->with('error', 'Erro desconhecido ao tentar inscrever.');
    }
}
