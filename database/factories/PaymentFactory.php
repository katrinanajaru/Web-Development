<?php

namespace Database\Factories;

use App\Models\Subservice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str ;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>function(){return  User::all() ->random();},
            'subservice_id'=>function(){return  Subservice::all() ->random();},
            'merchantRequestID' => Str::uuid(),
            'result'=>$this->faker->realText(100,1),
            'checkoutRequestID'=> Str::uuid(),
            'resultCode'=>$this->faker->numberBetween(0,4),
            'responseCode' => $this->faker->realText(100,1),
            'resultDesc' => $this->faker->realText(100,1),
            'responseDescription' => $this->faker->realText(100,1),
            'customerMessage' => $this->faker->realText(100,1),
            'mpesaReceiptNumber' => $this->faker->phoneNumber(),
            'phoneNumber' => $this->faker->phoneNumber(),
            'amount'=>$this->faker->numberBetween(100,4000),
            'active'=>$this->faker->boolean(),
            'transactionDate'=>$this->faker->date(),


        ];
    }
}
