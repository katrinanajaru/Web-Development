<?php

use App\Models\Subservice;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date') ;
            $table->foreignIdFor(Subservice::class,'subservice_id');
            $table->foreignIdFor(User::class,'user_id'); //client Id
            $table->foreignIdFor(User::class,'employee_id')->nullable(); //assigned employee id
            $table->enum('status',['pending','rejected','approved','completed'])->default('pending') ;
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
