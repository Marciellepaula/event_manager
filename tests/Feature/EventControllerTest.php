<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_event_index_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('events.index'));

        $response->assertStatus(200);
    }

    #[Test]
    public function it_creates_an_event()
    {

        $user = User::factory()->create();
        $this->actingAs($user);


        $eventData = [
            'title' => 'New Event',
            'description' => 'Event description',
            'start_datetime' => now()->addDays(1)->format('Y-m-d H:i:s'),
            'end_datetime' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'location' => 'Conference Hall',
            'max_capacity' => 100,
            'status' => 'open',
        ];

        $response = $this->post(route('events.store'), $eventData);

        $response->assertRedirect(route('events.index'));


        $this->assertDatabaseHas('events', ['title' => 'New Event']);
    }


    #[Test]


    public function test_it_updates_an_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $event = Event::factory()->create();

        $updatedData = [
            'title' => 'Updated Event',
            'description' => 'Updated description',
            'start_datetime' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'end_datetime' => now()->addDays(4)->format('Y-m-d H:i:s'),
            'location' => 'Updated Location',
            'max_capacity' => 150,
            'status' => 'open',
        ];

        $response = $this->put(route('events.update', $event->id), $updatedData);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', ['title' => 'Updated Event']);
    }

    #[Test]
    public function it_deletes_an_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $event = Event::factory()->create();

        $response = $this->delete(route('events.destroy', $event->id));

        $response->assertRedirect(route('events.index'));

        $this->assertSoftDeleted('events', ['id' => $event->id]);
    }
}
