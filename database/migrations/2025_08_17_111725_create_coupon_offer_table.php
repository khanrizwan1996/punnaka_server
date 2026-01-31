<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        if (!Schema::hasTable('coupon_offer')) {
        Schema::create('coupon_offer', function (Blueprint $table) {
            $table->increments('cf_id');
            $table->integer('cf_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->integer('cf_user_id')->default(0);
            $table->string('cf_main_cat', 255)->nullable();
            $table->string('cf_sub_cat', 255)->nullable();

            $table->string('cf_listing_type', 255)->nullable();
            $table->string('cf_title', 255)->nullable();
            $table->string('cf_short_tagline', 255)->nullable();
            $table->string('cf_store_name', 255)->nullable();
            $table->string('cf_city', 255)->nullable();
            $table->string('cf_start_date', 255)->nullable();
            $table->string('cf_end_date', 255)->nullable();
            $table->string('cf_store_website', 255)->nullable();
            $table->string('cf_ongoing_offer', 255)->nullable();

            $table->string('cf_sort_priority', 255)->nullable();
            $table->string('cf_store_logo', 255)->nullable();
            $table->string('cf_banner_thumbnail', 255)->nullable();
            $table->string('cf_user_type', 255)->nullable();
            $table->string('cf_platform', 255)->nullable();
            $table->string('cf_highlight_options', 255)->nullable();
            $table->text('cf_term_condition')->nullable();
            $table->longText('cf_desc')->nullable();
            $table->text('cf_admin_note')->nullable();
            
            $table->string('cf_coupon_code_required', 255)->nullable();
            $table->string('cf_coupon_promo_code', 255)->nullable();
            $table->string('cf_coupon_discount_type', 255)->nullable();
            $table->string('cf_coupon_discount_value', 255)->nullable();

            $table->string('cf_coupon_min_order_value', 255)->nullable();
            $table->string('cf_coupon_max_discount_cap', 255)->nullable();
            $table->string('cf_coupon_login_required_redeem', 255)->nullable();
            $table->string('cf_coupon_redemption_limit', 255)->nullable();
            $table->string('cf_coupon_redirect_affiliate_url', 255)->nullable();

            $table->string('cf_offer_code_required', 255)->nullable();
            $table->string('cf_offer_type', 255)->nullable();
            $table->string('cf_offer_discount_value', 255)->nullable();
            $table->string('cf_offer_cta_buy_now_url', 255)->nullable();
            $table->string('cf_offer_valid_till', 255)->nullable();
            $table->longText('cf_offer_desc')->nullable();

            $table->string('cf_free_sample_freebie_type', 255)->nullable();
            $table->string('cf_free_sample_quantity', 255)->nullable();
            $table->string('cf_free_sample_eligible_users', 255)->nullable();
            $table->string('cf_free_sample_redemption_link', 255)->nullable();
            $table->longText('cf_free_sample_desc')->nullable();

            $table->string('cf_free_recharge_type', 255)->nullable();
            $table->string('cf_free_recharge_eligible_operators', 255)->nullable();
            $table->string('cf_free_recharge_recharge_code', 255)->nullable();
            $table->string('cf_free_recharge_claim_url', 255)->nullable();
            $table->text('cf_free_recharge_recharge_instructions')->nullable();
          
            $table->dateTime('cf_added_time')->nullable();
            $table->dateTime('cf_changed_time')->nullable();
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
        Schema::dropIfExists('coupon_offer');
    }
}
