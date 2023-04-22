<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
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
            "description" => $this->faker->paragraph(1),
            "category_id" => Category::all()->random()->id,
        ];
    }
}
