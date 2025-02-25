<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition(): array
    {
        $startDateTime = $this->faker->dateTimeBetween('now', '+1 month');
        $endDateTime = Carbon::instance($startDateTime)->addHours(rand(1, 5));

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'location' => $this->faker->address(),
            'max_capacity' => $this->faker->numberBetween(10, 200),
            'status' => $this->faker->randomElement(['open', 'closed', 'canceled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
