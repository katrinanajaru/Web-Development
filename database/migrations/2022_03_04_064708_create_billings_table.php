<?php

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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string("name") ;
            $table->longText("reason")->nullable() ;
            $table->decimal("amount")->nullable() ;
            $table->foreignIdFor(User::class,'created_by');//should be created by either employee or manager
            $table->foreignIdFor(User::class,'confirmed_by')->nullable(); //Should be confirmed by manager
            $table->enum("status",['pending','approved','rejected'])->default('pending');
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
        Schema::dropIfExists('billings');
    }
};
