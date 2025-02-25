<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        $events = Event::all();

        if ($users->isEmpty() || $events->isEmpty()) {
            $users = User::factory()->count(10)->create();
            $events = Event::factory()->count(5)->create();
        }

        Registration::factory()->count(5)->create([
            'user_id' => $users->random()->id,
            'event_id' => $events->random()->id,
        ]);
    }
}
