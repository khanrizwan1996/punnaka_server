<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('offer_id');
            $table->integer('offer_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->integer('offer_user_id')->default(0);
            $table->integer('offer_mall_id')->default(0);
            $table->integer('offer_brand_id')->default(0);
            $table->string('offer_main_category')->nullable();
            $table->string('offer_sub_category')->nullable();
            $table->string('offer_title')->nullable();
            $table->string('offer_country')->nullable();
            $table->string('offer_state')->nullable();
            $table->string('offer_city')->nullable();
            $table->string('offer_start_date')->nullable();
            $table->string('offer_start_time')->nullable();
            $table->string('offer_end_date')->nullable();
            $table->string('offer_end_time')->nullable();
            $table->longText('offer_detail')->nullable();
            $table->string('offer_image')->nullable();
            $table->text('offer_meta_title')->nullable();
            $table->text('offer_meta_keyword')->nullable();
            $table->text('offer_meta_description')->nullable();
            $table->dateTime('offer_added_timestamp')->nullable();
            $table->dateTime('offer_changed_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
