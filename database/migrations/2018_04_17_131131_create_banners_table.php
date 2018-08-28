<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('url_image')->nullable();
            $table->enum('status',['ACTIVE','DISABLED','EXPIRED','WAITING','CONSUMED']);

            $table->unsignedInteger('type_id')->length(10)->nullable();
            /*$table->foreign('type_id')->
							references('id')->
							on('types')->onDelete('cascade');*/
			$table->unsignedInteger('subtype_id')->length(10)->nullable();
			/*$table->foreign('subtype_id')->
							references('id')->
							on('subtypes')->onDelete('cascade');*/
			
			$table->text('payload')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
