<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json($events, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $this->eventService->validateEvent($request);

        $event = $this->eventService->createEvent($validatedData);

        return $event
            ? response()->json(['message' => 'Evento criado com sucesso!', 'event' => $event], 201)
            : response()->json(['message' => 'Erro ao criar evento.'], 500);
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);
        return response()->json($event, 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->eventService->validateEvent($request);

        $updatedEvent = $this->eventService->updateEvent($id, $validatedData);

        return $updatedEvent
            ? response()->json(['message' => 'Evento atualizado com sucesso!', 'event' => $updatedEvent], 200)
            : response()->json(['message' => 'Erro ao atualizar evento.'], 500);
    }

    public function destroy($id)
    {
        $deleted = $this->eventService->deleteEvent($id);

        return $deleted
            ? response()->json(['message' => 'Evento deletado com sucesso!'], 200)
            : response()->json(['message' => 'Erro ao deletar evento.'], 500);
    }
}
