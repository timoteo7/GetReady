<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('provider_id')->length(10)->nullable();
			/*$table->foreign('provider_id')->
							references('id')->
							on('subtypes')->onDelete('cascade');*/

			$table->unsignedInteger('subtype_id')->length(10)->nullable();
			/*$table->foreign('subtype_id')->
							references('id')->
							on('subtypes')->onDelete('cascade');*/

			$table->decimal('amount',15,2)->nullable();
			$table->smallInteger('minutes',false)->nullable();

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
        Schema::dropIfExists('activities');
    }
}
