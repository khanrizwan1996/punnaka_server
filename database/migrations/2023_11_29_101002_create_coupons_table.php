<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('coupon_status')->nullable()->default(0)->comment('Active: 1 , InActive: 0');
            $table->string('coupon_user_id')->nullable();
            $table->string('coupon_country')->nullable();
            $table->string('coupon_state')->nullable();
            $table->string('coupon_city')->nullable();
            $table->string('coupon_main_category')->nullable();
            $table->string('coupon_sub_category')->nullable();
            $table->string('coupon_company_name')->nullable();
            $table->string('coupon_title')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_contact')->nullable();
            $table->string('coupon_website')->nullable();
            $table->string('coupon_end_date_time')->nullable();
            $table->string('coupon_image')->nullable();
            $table->string('coupon_location')->nullable();
            $table->string('coupon_brand_image')->nullable();
            $table->longText('coupon_product_services')->nullable();
            $table->longText('coupon_t_c')->nullable();
            $table->longText('coupon_description')->nullable();
            $table->longText('coupon_brand_detail')->nullable();
            $table->text('coupon_meta_title')->nullable();
            $table->text('coupon_meta_keyword')->nullable();
            $table->text('coupon_meta_description')->nullable();
            $table->dateTime('coupon_added_time')->nullable();
            $table->dateTime('coupon_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
