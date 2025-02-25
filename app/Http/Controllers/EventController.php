<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'open')->get();
        return view('admin.events.index', compact('events'));
    }


    public function painel()
    {
        $events = Event::where('status', 'open')->get();
        return view('admin.index', compact('events'));
    }


    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'status' => 'required|in:open,closed,canceled',
        ]);

        Event::create($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'status' => 'required|in:open,closed,canceled',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function showregistrations()
    {
        $registrations = Registration::with('event')->get();

        return view('admin.registration.index', compact('registrations'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Evento deletado com sucesso!');
    }
}
