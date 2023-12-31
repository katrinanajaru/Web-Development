<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'balance'=>$this->faker->numberBetween(2000,1000000),
            'moneyin'=>$this->faker->numberBetween(2000,1000000),
            'moneyout'=>$this->faker->numberBetween(2000,1000000)
        ];
    }
}
