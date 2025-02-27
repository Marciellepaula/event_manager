<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use App\Jobs\SendEventSubscriptionEmail;
use App\Jobs\SendEventUnsubscriptionEmail;
use App\Services\EventSubscriptionService;
use Tests\TestCase;


use PHPUnit\Framework\Attributes\Test;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;


    #[Test]
    public function it_subscribes_user_to_event_successfully()
    {
        Bus::fake();
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'open',
            'max_capacity' => 100
        ]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->subscribeToEvent($event->id);

        $this->assertEquals(['success' => 'Inscrição realizada com sucesso!'], $response);
        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
        Bus::assertDispatched(SendEventSubscriptionEmail::class);
    }

    #[Test]
    public function it_shows_error_when_event_capacity_is_full()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'open',
            'max_capacity' => 1
        ]);

        Registration::create(['user_id' => User::factory()->create()->id, 'event_id' => $event->id]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->subscribeToEvent($event->id);

        $this->assertEquals(['error' => 'Capacidade máxima atingida ou o evento não está mais aberto.'], $response);
    }

    #[Test]
    public function it_shows_error_when_event_is_closed()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'closed',
            'max_capacity' => 100
        ]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->subscribeToEvent($event->id);

        $this->assertEquals(['error' => 'Capacidade máxima atingida ou o evento não está mais aberto.'], $response);
    }
    #[Test]
    public function it_shows_error_when_user_is_already_subscribed()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'open',
            'max_capacity' => 100
        ]);

        Registration::create(['user_id' => $user->id, 'event_id' => $event->id]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->subscribeToEvent($event->id);

        $this->assertEquals(['error' => 'Você já está inscrito neste evento.'], $response);
    }
    #[Test]
    public function it_unsubscribes_user_from_event_successfully()
    {
        Bus::fake();

        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'open',
            'max_capacity' => 100
        ]);

        Registration::create(['user_id' => $user->id, 'event_id' => $event->id]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->unsubscribeFromEvent($event->id);

        $this->assertEquals(['success' => 'Inscrição cancelada com sucesso!'], $response);
        $this->assertSoftDeleted('registrations', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
        Bus::assertDispatched(SendEventUnsubscriptionEmail::class);
    }

    #[Test]
    public function it_shows_error_when_user_is_not_registered_for_event_to_unsubscribe()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'status' => 'open',
            'max_capacity' => 100
        ]);

        Auth::login($user);

        $response = app(EventSubscriptionService::class)->unsubscribeFromEvent($event->id);

        $this->assertEquals(['error' => 'Inscrição não encontrada.'], $response);
    }
}
