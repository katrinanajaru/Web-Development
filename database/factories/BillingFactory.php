<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */
class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word() ,
            'reason'=>$this->faker->realText(),
            'amount'=>$this->faker->numberBetween(100,2000),
            'created_by'=>function(){return  User::where('role','employee')->orWhere('role','manager')->get() ->random();},
            'confirmed_by'=>function(){return  User::where('role','manager')->get()->random();}
        ];
    }
}
