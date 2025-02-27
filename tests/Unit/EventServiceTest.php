<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EventServiceTest extends TestCase
{
    use RefreshDatabase;

    protected EventService $eventService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventService = app(EventService::class);
    }

    #[Test]
    public function it_creates_an_event_successfully(): void
    {
        $eventData = [
            'title' => 'Test Event',
            'description' => 'Test Description',
            'start_datetime' => now(),
            'end_datetime' => now()->addHour(),
            'location' => 'Test Location',
            'max_capacity' => 100,
            'status' => 'open'
        ];

        $event = $this->eventService->createEvent($eventData);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals('Test Event', $event->title);
        $this->assertEquals(100, $event->max_capacity);
    }
}
