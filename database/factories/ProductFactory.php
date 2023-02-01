<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { $name=$this->faker->text(10);
        return [
            'name' => $name,
            'category_id'=>rand(2,7),
            'active'=>rand(0,1),
            'price'=>rand(200,1500),
            'photo'=>'Z092023312023digital_15.jpg',
            'quantity'=>rand(0,30),
            'longdescription'=>$this->faker->text(300),
            'description'=>$this->faker->text(60),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
