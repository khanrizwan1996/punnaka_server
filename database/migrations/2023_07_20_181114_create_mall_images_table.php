<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMallImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mall_images', function (Blueprint $table) {
            $table->id('mall_img_id');
            $table->string('mall_img_mall_id');
            $table->string('mall_img_status')->nullable()->default(0)->comment('active = 1 , in active = 1');
            $table->string('mall_img_path')->nullable();
            $table->dateTime('mall_img_added_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mall_images');
    }
}
