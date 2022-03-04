<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Services;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        $this->call([
            AttendanceSeeder::class,
            ServiceSeeder::class,
            SubserviceSeeder::class,
            AppointmentSeeder::class,
            PaymentSeeder::class,
            BillingSeeder::class,
            WalletSeeder::class

        ]);


    }
}
