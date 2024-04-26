<?php

namespace Database\Factories;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Ask question', 'Sign off']),
            'desc' => fake()->text(50),
            'code' => fake()->text(50),
            'link' => fake()->url(),
            'assistant_id' => null,
        ];
    }

    public function withStudent($student)
    {
        return $this->state([
            'lab_id' => $student->lab->id,
            'student_id' => $student->id,
        ]);
    }
}
