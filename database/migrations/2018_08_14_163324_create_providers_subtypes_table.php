<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersSubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_subtype', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('provider_id')->length(10);
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->unsignedInteger('subtype_id')->length(10);
            $table->foreign('subtype_id')->references('id')->on('subtypes');
            $table->timestamps();
        });

        //Schema::table('provider_subtype', function($table) {
        //});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provider_subtype');
    }
}
