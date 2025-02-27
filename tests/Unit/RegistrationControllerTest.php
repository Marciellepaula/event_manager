<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Services\EventSubscriptionService;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

use PHPUnit\Framework\Attributes\Test;

class RegistrationControllerTest extends TestCase
{
    private $eventSubscriptionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventSubscriptionService = Mockery::mock(EventSubscriptionService::class);
    }

    public function test_it_subscribes_user_to_event()
    {
        $user = User::factory()->make();
        $event = Event::factory()->make(['status' => 'open', 'max_capacity' => 100]);

        $this->eventSubscriptionService
            ->shouldReceive('subscribeToEvent')
            ->once()
            ->with($user, $event->id)
            ->andReturn(['success' => 'Inscrição realizada com sucesso!']);

        $response = $this->eventSubscriptionService->subscribeToEvent($user, $event->id);

        $this->assertEquals(['success' => 'Inscrição realizada com sucesso!'], $response);
    }

    public function test_it_shows_error_when_event_capacity_is_full()
    {
        $user = User::factory()->make();
        $event = Event::factory()->make(['status' => 'open', 'max_capacity' => 1]);

        $this->eventSubscriptionService
            ->shouldReceive('subscribeToEvent')
            ->once()
            ->with($user, $event->id)
            ->andReturn(['error' => 'Capacidade máxima atingida ou o evento não está mais aberto.']);

        $response = $this->eventSubscriptionService->subscribeToEvent($user, $event->id);

        $this->assertEquals(['error' => 'Capacidade máxima atingida ou o evento não está mais aberto.'], $response);
    }

    public function test_it_shows_error_when_user_is_already_subscribed()
    {
        $user = User::factory()->make();
        $event = Event::factory()->make(['status' => 'open', 'max_capacity' => 100]);

        $this->eventSubscriptionService
            ->shouldReceive('subscribeToEvent')
            ->once()
            ->with($user, $event->id)
            ->andReturn(['error' => 'Você já está inscrito neste evento.']);

        $response = $this->eventSubscriptionService->subscribeToEvent($user, $event->id);

        $this->assertEquals(['error' => 'Você já está inscrito neste evento.'], $response);
    }

    public function test_it_unsubscribes_user_from_event_successfully()
    {
        $user = User::factory()->make();
        $event = Event::factory()->make(['status' => 'open', 'max_capacity' => 100]);

        $this->eventSubscriptionService
            ->shouldReceive('unsubscribeFromEvent')
            ->once()
            ->with($user, $event->id)
            ->andReturn(['success' => 'Inscrição cancelada com sucesso!']);

        $response = $this->eventSubscriptionService->unsubscribeFromEvent($user, $event->id);

        $this->assertEquals(['success' => 'Inscrição cancelada com sucesso!'], $response);
    }
}
