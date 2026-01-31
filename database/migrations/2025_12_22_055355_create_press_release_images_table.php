<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePressReleaseImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('press_release_images')) {
        Schema::create('press_release_images', function (Blueprint $table) {
            $table->increments('pri_id');
            $table->integer('pri_press_release_id')->nullable(false);
            $table->string('pri_path', 255)->nullable();
            $table->dateTime('pri_added_time')->nullable();
             $table->index('pri_press_release_id','pri_press_release_id_index');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('press_release_images');
    }
}
