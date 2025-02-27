<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Services\EventSubscriptionService;


class RegistrationController extends Controller
{

    protected $eventSubscriptionService;

    public function __construct(EventSubscriptionService $eventSubscriptionService)
    {
        $this->eventSubscriptionService = $eventSubscriptionService;
    }

    public function index()
    {

        $events = Event::get();
        return view('participant.index', compact('events'));
    }



    public function subscribeToEvent($eventId)
    {

        $response = $this->eventSubscriptionService->subscribeToEvent($eventId);


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

        $response = $this->eventSubscriptionService->unsubscribeFromEvent($eventId);
        if (isset($response['success'])) {
            return redirect()->back()->with('success', $response['success']);
        }

        return redirect()->back()->with('error', 'Erro desconhecido ao tentar inscrever.');
    }
}
