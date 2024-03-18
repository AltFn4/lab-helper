<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\Room;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Room::all() as $room)
        {
            $id = $room->id;
            for ($i = 0; $i < 20; $i++)
            {
                Seat::create([
                    'room_id' => $id,
                ])->save();
            }
        }
    }
}
