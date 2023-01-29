<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {  $name=$this->faker->text(10);
        return [
            'name' => $name,
            'active'=>rand(0,1),
            'photo'=>'Z092022312022g.jpg',
            'slug'=>fake()->unique()->text(10),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
