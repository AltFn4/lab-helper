<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;
use App\Models\Seat;
use App\Models\Submission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Lab::factory(10)->create();
        Lab::factory()->create([
            'name' => 'cofo 201',
        ]);

        foreach(Lab::all() as $lab)
        {
            $id = $lab->id;
            for ($i = 0; $i < 20; $i++)
            {
                $seat = new Seat;
                $seat->lab_id = $id;
                $seat->save();
            }
        }

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Tristan',
            'email' => '2143975@swansea.ac.uk',
            'password' => 'qwerty123',
            'role' => 'assistant',
        ]);

        $seat = Seat::find(1);
        $seat->user_id = 1;
        $seat->update();

        Submission::factory(10)->create();
        Submission::factory()->create([
            'user_id' => 11,
            'code' => 'print("Hello World!")',
        ]);
    }
}
