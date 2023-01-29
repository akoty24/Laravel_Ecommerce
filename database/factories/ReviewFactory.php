<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id'=>rand(1,100),
            'user_id'=>rand(1,30),
            'order_item_id'=>rand(1,100),
            'rating'=>rand(1,5),
            'comment'=>$this->faker->text(600),
            'status'=>rand(0,1),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
