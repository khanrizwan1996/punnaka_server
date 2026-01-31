<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('brand_id');
            $table->integer('brand_mall_id')->default(0);
            $table->string('brand_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->string('brand_name')->nullable();
            $table->string('brand_contact_no');
            $table->string('brand_email');
            $table->string('brand_main_cat');
            $table->string('brand_sub_cat');
            $table->string('brand_prodct_services');
            $table->string('brand_store_type');
            $table->string('brand_floor');
            $table->string('brand_area');
            $table->string('brand_location');
            $table->string('brand_city');
            $table->string('brand_store_timings');
            $table->string('brand_store_weekend_timings');
            $table->string('brand_store_weekday_timings');
            $table->string('brand_logo');
            $table->longText('brand_desc')->nullable();
            $table->text('brand_meta_title')->nullable();
            $table->text('brand_meta_keyword')->nullable();
            $table->text('brand_meta_description')->nullable();
            $table->dateTime('brand_added_time')->nullable();
            $table->dateTime('brand_changed_time')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
