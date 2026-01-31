<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('newsletters')) {
        Schema::create('product_service', function (Blueprint $table){
            $table->increments('ps_id');
            $table->integer('ps_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->integer('ps_user_id')->default(0);
            $table->string('ps_main_cat', 255)->nullable();
            $table->string('ps_sub_cat', 255)->nullable();
            $table->string('ps_title', 255)->nullable();
            $table->string('ps_listing_type', 255)->nullable();
            $table->string('ps_pricing_type', 255)->nullable();
            $table->string('ps_currency', 255)->nullable();
            $table->string('ps_price_range', 255)->nullable();
            $table->string('ps_discount', 255)->nullable();
            $table->string('ps_tax', 255)->nullable();

            $table->string('ps_country', 255)->nullable();
            $table->string('ps_state', 255)->nullable();
            $table->string('ps_city', 255)->nullable();

            $table->string('ps_service_area', 255)->nullable();
            $table->string('ps_availability_date_time', 255)->nullable();
            $table->string('ps_additional_options', 255)->nullable();

            $table->string('ps_size', 255)->nullable();
            $table->string('ps_color', 255)->nullable();
            $table->longText('ps_return_policy')->nullable();

            $table->longText('ps_cancellation_policy')->nullable();
            $table->string('ps_add_ons', 255)->nullable();

            $table->string('ps_stock', 255)->nullable();
            $table->string('ps_sku', 255)->nullable();
            $table->string('ps_shipping_option', 255)->nullable();

            $table->string('ps_image', 255)->nullable();
            $table->string('ps_video_url', 255)->nullable();
            $table->string('ps_brochure', 255)->nullable();
            
            $table->string('ps_contact_name', 255)->nullable();
            $table->string('ps_contact_number', 255)->nullable();
            $table->string('ps_contact_email', 255)->nullable();
            $table->string('ps_contact_whatsapp', 255)->nullable();
            
            $table->string('ps_website_url', 255)->nullable();
            $table->string('ps_portfolio_url', 255)->nullable();
            $table->string('ps_facebook_url', 255)->nullable();
            $table->string('ps_instagram_url', 255)->nullable();
            $table->string('ps_twitter_url', 255)->nullable();
            $table->string('ps_other_url', 255)->nullable();
            
            $table->string('ps_visibility', 255)->nullable();
            $table->string('ps_featured_listing', 255)->nullable();
            $table->string('ps_expiry_date', 255)->nullable();
            $table->string('ps_tags_keywords', 255)->nullable();

            $table->text('ps_short_description')->nullable();
            $table->longText('ps_detail_description')->nullable();
            $table->dateTime('ps_added_time')->nullable();
            $table->dateTime('ps_changed_time')->nullable();
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
        Schema::dropIfExists('product_service');
    }
}
