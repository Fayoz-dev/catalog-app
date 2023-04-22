<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "surname" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "password" => 'admin',
            "phone" => $this->faker->numberBetween(1560000,9876254),
           

        ];
    }
}
