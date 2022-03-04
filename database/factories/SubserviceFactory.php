<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subservice>
 */
class SubserviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id'=>function(){return Service::all()->random();},
            'name'=>$this->faker->word() ,
            'price'=>$this->faker->numberBetween(100,3000),
            'description'=>$this->faker->realText(),

        ];
    }
}
