<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('individual_id')->length(10)->nullable();
            $table->tinyInteger('profile')->unsigned()->nullable();

            $table->decimal('latitude',9,6);
            $table->decimal('longitude',9,6);
            $table->string('street',100)->nullable();
            $table->string('number',15)->nullable();
            $table->string('district',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',15)->nullable();
            
            $table->string('postcode',12)->nullable();
            
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
        Schema::dropIfExists('places');
    }
}
