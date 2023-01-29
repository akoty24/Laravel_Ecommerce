<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fname' => fake()->name(),
            'lname'=>fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=>'123456789',
            'address'=>'Cairo / Egypt',
            'address2'=>'Roma / italy',
            'city'=>'Cairo',
            'country'=>'Egypt',
            'pincode'=>rand(1,5),
            'status'=>'1',
            'total_price'=>'9999',
            'payment_mode'=>'paypal',
            'payment_id'=>rand(1,100),
            'user_id'=>rand(1,33),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
