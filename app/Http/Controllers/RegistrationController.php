<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RegistrationController extends Controller
{
    public function index()
    {
        // $inscricoes = Registration::where('user_id', Auth::id())->with('event')->get();

        $events = Event::where('status', 'open')->get();
        return view('participant.index', compact('events'));
    }


    public function inscrever($eventoId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventoId);

        if ($event->status !== 'open' || $event->registrations()->count() >= $event->max_capacity) {
            return redirect()->back()->with('error', 'Inscrição não permitida.');
        }

        if ($user->registrations()->where('event_id', $eventoId)->exists()) {
            return redirect()->back()->with('error', 'Você já está inscrito neste evento.');
        }

        $registration = $user->registrations()->create([
            'event_id' => $eventoId,
            'user_id' => $user->id
        ]);



        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }




    public function cancelar($eventoId)
    {
        $user = auth()->user();
        $registration = $user->registrations()->where('event_id', $eventoId)->first();

        if (!$registration) {
            return redirect()->back()->with('error', 'Você não está inscrito neste evento.');
        }

        $registration->delete();

        return redirect()->back()->with('success', 'Inscrição cancelada.');
    }
}
