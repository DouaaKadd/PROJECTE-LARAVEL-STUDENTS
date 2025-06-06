<?php

namespace Database\Factories;

use App\Models\Cicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => $this->faker->name, 
            'email' => $this->faker->unique()->safeEmail, 
            'address' => $this->faker->address, 
            'birth_date' => $this->faker->date, 
            'num_telefon' => $this->faker->phoneNumber, 
            'user_id' => User::factory(), 
            //'cicle_id' => null, 

        ];
    }
}
