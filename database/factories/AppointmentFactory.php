<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'date'=>$this->faker->date(),
            'service_id'=>function(){return Services::all()->random();},
            'user_id'=>function(){return User::all()->random();},
            'description'=>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),


        ];
    }
}
