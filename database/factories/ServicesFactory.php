<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

           'name'=>$this->faker->name,
           'amount'=>$this->faker->numberBetween('300','1000'),
           'description'=>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),

        ];
    }
}
