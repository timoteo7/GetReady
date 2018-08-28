<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',191)->unique();
            $table->decimal('value',15,2)->nullable();
            $table->decimal('percentage',15,2)->nullable();
            $table->date('validity_start')->nullable();
            $table->date('validity_end')->nullable();
            $table->enum('status',['ACTIVE','DISABLED','EXPIRED','WAITING','CONSUMED']);
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
        Schema::dropIfExists('coupons');
    }
}
