<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventService
{
    public function validateEvent(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'status' => 'required|in:open,closed,canceled',
        ]);
    }

    public function getAllEvents()
    {
        return Event::paginate(10);
    }

    public function getEventById($id)
    {
        return Event::findOrFail($id);
    }

    public function createEvent(array $data)
    {
        try {
            return Event::create($data);
        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return false;
        }
    }

    public function updateEvent($id, array $data)
    {
        $event = Event::findOrFail($id);

        try {
            $event->update($data);
            return $event;
        } catch (\Exception $e) {
            Log::error('Error updating event: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        try {
            $event->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Error deleting event: ' . $e->getMessage());
            return false;
        }
    }
}
