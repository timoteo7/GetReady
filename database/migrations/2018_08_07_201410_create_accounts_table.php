<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('provider_id')->length(10);
            $table->timestamp('emission');
            $table->decimal('amount', 15, 2);
            $table->unsignedInteger('order_id')->length(10)->nullable();
            $table->date('expiration')->nullable();
            $table->date('payment')->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('fine', 15, 2)->nullable();
            $table->string('issuer', 30)->nullable();
            $table->string('recipient', 30)->nullable();
            $table->text('note')->nullable ();
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
        Schema::drop('accounts');
    }
}
