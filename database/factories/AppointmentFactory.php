<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Services;
use App\Models\Subservice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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

            'date'=>$this->faker->date($max= Carbon::now()->subDays(50) ),
            'subservice_id'=>function(){return Subservice::all()->random();},
            'user_id'=>function(){return User::all()->random();},
            'employee_id'=>function(){return User::where('role','employee')->get() ->random();},
            'status'=>$this->faker->randomElement(['pending','rejected','approved','completed']),
            'description'=>$this->faker->realText(150),


        ];
    }
}
