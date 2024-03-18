<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $no_of_modules = Module::count();
        $no_of_rooms = Room::count();
        return [
            'module_id' => random_int(1, $no_of_modules),
            'room_id' => random_int(1, $no_of_rooms),
            'duration' => random_int(1, 4),
            'start_time' => fake()->dateTimeBetween('now', '+2 years'),
        ];
    }
}
