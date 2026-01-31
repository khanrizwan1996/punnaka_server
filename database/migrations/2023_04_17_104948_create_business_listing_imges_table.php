<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingImgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing_images', function (Blueprint $table) {
            $table->id('bus_img_id');
            $table->string('bus_img_status')->nullable()->default(0);
            $table->string('bus_img_type')->nullable();
            $table->string('bus_img_path')->nullable();
            $table->dateTime('bus_img_added_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_listing_images');
    }
}
