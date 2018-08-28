<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id',true);
            $table->text('name');
            $table->string('email')->unique();
            $table->string('home_phone',40)->nullable();
            $table->string('mobile_phone',40)->nullable();
            $table->string('rg',15)->nullable();
            $table->string('cpf',15)->nullable();
            $table->unsignedInteger('main_place_id')->length(10)->nullable();
            $table->string('url_image')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('bank',20)->nullable();
            $table->string('ag',20)->nullable();
            $table->string('account',20)->nullable();
            $table->string('variation',20)->nullable();
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
        Schema::dropIfExists('providers');
    }
}
