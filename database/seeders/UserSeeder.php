<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(30)->create()->each(function ($user) {
            $user->assignRole('student');
            fake()->randomElement($user->lab->room->seats->filter(function($seat)
            {
                return $seat->user_id == null;
            }))->update(['user_id' => $user->id]);
            Inquiry::factory()->withStudent($user)->create();
        });

        User::factory()->create([
            'name' => 'Tristan',
            'email' => '2143975@swansea.ac.uk',
            'password' => 'qwerty123',
        ])->assignRole('assistant');

        User::factory()->create([
            'name' => 'Hello',
            'email' => '2233445@swansea.ac.uk',
            'password' => 'qwerty123',
        ])->assignRole('student');

        User::factory()->create([
            'name' => 'Bot',
            'email' => '2211221@swansea.ac.uk',
            'password' => 'qwerty123',
        ])->assignRole('student');
    }
}
