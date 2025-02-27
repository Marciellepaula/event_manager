<?php

namespace App\Http\Controllers;

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
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->eventService->validateEvent($request);

        $event = $this->eventService->createEvent($validatedData);

        return $event
            ? redirect()->route('events.index')->with('success', 'Evento criado com sucesso!')
            : redirect()->back()->with('error', 'Erro ao criar evento.');
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);
        return view('admin.events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = $this->eventService->getEventById($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->eventService->validateEvent($request);

        $updatedEvent = $this->eventService->updateEvent($id, $validatedData);

        return $updatedEvent
            ? redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!')
            : redirect()->back()->with('error', 'Erro ao atualizar evento.');
    }

    public function destroy($id)
    {
        $deleted = $this->eventService->deleteEvent($id);

        return $deleted
            ? redirect()->route('events.index')->with('success', 'Evento deletado com sucesso!')
            : redirect()->back()->with('error', 'Erro ao deletar evento.');
    }

    public function showregistrations()
    {
        $registrations = $this->eventService->getAllEventsRegistration();
        return view('admin.registration.index', compact('registrations'));
    }

    public function painel()
    {
        $events = $this->eventService->getAllEvents();
        return view('admin.index', compact('events'));
    }
}
