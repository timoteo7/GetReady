<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id')->length(10)->nullable();
            /*$table->foreign('type_id')->
							references('id')->
							on('types')->onDelete('cascade');*/
            $table->string('description',150);
            $table->decimal('amount',15,2)->nullable();
            $table->smallInteger('minutes')->nullable();
            $table->string('url_image')->nullable();
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
        Schema::dropIfExists('subtypes');
    }
}
