<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('place_id')->length(10);
            $table->unsignedInteger('customer_id')->length(10);
            $table->unsignedInteger('subtype_id')->length(10);
            $table->unsignedInteger('provider_id')->length(10);
            $table->unsignedInteger('activitie_id')->length(10);
            $table->timestamp('schedule')->nullable();
            $table->enum('status',['WAITING_PROVIDER_POSTULATION','WAITING_CUSTOMER_PAYMENT','WAITING_CUSTOMER_PAYMENT_CONFIRMATION','WAITING_PROVIDER_CHECKOUT','WAITING_CUSTOMER_CHECKOUT','PROVIDER_PAYMENT_READY','PROVIDER_PAYMENT_DONE'])->nullable();
            $table->decimal('discount',15,2)->nullable();
            $table->decimal('travel_fee',15,2)->nullable();
            $table->string('transaction_code',50)->nullable();
            $table->unsignedInteger('account_id')->length(10)->nullable();
            $table->unsignedInteger('rating')->length(10)->nullable();
            
            $table->text('note')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
