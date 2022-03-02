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
        User::factory(10)->create();
        Services::factory(20)->create();
        Appointment::factory(10)->create();

    }
}
