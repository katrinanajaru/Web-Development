<?php

use App\Models\Subservice;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('merchantRequestID')->nullable();
            $table->text('result')->nullable();
            $table->string('checkoutRequestID');
            $table->integer('resultCode')->nullable();
            $table->integer('responseCode')->nullable();
            $table->string('resultDesc')->nullable();
            $table->string('responseDescription')->nullable();
            $table->string('customerMessage')->nullable();
            $table->string('mpesaReceiptNumber')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->float('amount')->nullable();
            $table->float('balance')->nullable();
            $table->boolean('active')->default(true);
            $table->dateTime('transactionDate')->nullable();
            $table->foreignIdFor(Subservice::class,'subservice_id')->nullable();
            $table->foreignIdFor(User::class,'user_id') ;

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
        Schema::dropIfExists('payments');
    }
};
