<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\EventService;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;



class EventServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $eventService;

    public function setUp(): void
    {
        parent::setUp();
        $this->eventService = new EventService();
    }


    public function it_creates_an_event_successfully()
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


    public function it_allows_registration_until_max_capacity_is_reached()
    {
        $event = Event::factory()->create(['max_capacity' => 2]);

        $this->eventService->registerUserToEvent($event, 1);
        $this->eventService->registerUserToEvent($event, 2);

        $this->assertEquals(2, $event->users()->count());

        $this->expectException(\Exception::class);
        $this->eventService->registerUserToEvent($event, 3);
    }


    public function it_allows_event_cancellation()
    {
        $event = Event::factory()->create();

        $this->eventService->cancelEvent($event);

        $this->assertEquals('canceled', $event->status);
    }


    public function it_checks_capacity_limit_validation()
    {
        $event = Event::factory()->create(['max_capacity' => 2]);

        $this->assertTrue($this->eventService->validateCapacity($event, 1));
        $this->assertFalse($this->eventService->validateCapacity($event, 3));
    }
}
