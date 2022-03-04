<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'arrived_time'=>$this->faker->date(),
            'leave_time'=>$this->faker->date(),
            'employee_id'=>function(){return  User::where('role','employee') ->random();},

        ];
    }
}
