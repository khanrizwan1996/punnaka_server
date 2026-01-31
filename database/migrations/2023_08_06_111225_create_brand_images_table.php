<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_images', function (Blueprint $table) {
            $table->increments('brand_img_id');
            $table->string('brand_img_brand_id');
            $table->string('brand_img_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->string('brand_img_path')->nullable();
            $table->dateTime('brand_img_added_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_images');
    }
}
