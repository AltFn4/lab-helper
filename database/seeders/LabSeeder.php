<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lab::factory(10)->create();
        Lab::factory()->create([
            'module_id' => 1,
            'room_id' => 1,
            'duration' => 1,
            'start_time' => now()->toDateTimeString(),
        ]);
    }
}
