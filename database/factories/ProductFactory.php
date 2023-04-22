<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            "image" => $this->faker->name(),
            "organization_id" => Organization::all()->random()->id,
            "description" => $this->faker->lastName(),
            "price" => $this->faker->numberBetween(1,50),
            "status" => $this->faker->randomElement(['active','inactive']),

        ];
    }
}
