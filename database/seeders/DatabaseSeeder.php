<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;
use App\Models\Seat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ModuleSeeder::class,
            RoomSeeder::class,
            SeatSeeder::class,
            LabSeeder::class,
            UserSeeder::class,
        ]);
    }
}
