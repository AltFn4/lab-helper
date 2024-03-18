<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lab;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('student');
        });

        User::factory()->create([
            'name' => 'Tristan',
            'email' => '2143975@swansea.ac.uk',
            'password' => 'qwerty123',
            'lab_id' => 1,
        ])->assignRole('assistant');

        User::factory()->create([
            'name' => 'Hello',
            'email' => 'hello@example.com',
            'password' => 'qwerty123',
            'lab_id' => 1,
        ])->assignRole('student');
    }
}
