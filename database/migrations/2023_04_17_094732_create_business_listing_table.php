<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listing', function (Blueprint $table) {
            
            $table->id('bus_id');
            $table->bigInteger('bus_status')->nullable()->default(0);
            $table->bigInteger('bus_multiple_excel_status')->nullable()->default(0);
            $table->bigInteger('bus_user_id')->nullable()->default(0);
            $table->string('bus_plan_type')->nullable();
            $table->string('bus_name')->nullable();
            
            $table->string('bus_contact_no')->nullable();
            $table->string('bus_alt_contact_no')->nullable();
            $table->string('bus_email')->nullable();
            
            $table->string('bus_state')->nullable();
            $table->string('bus_country')->nullable();
            $table->string('bus_city')->nullable();
            
            $table->string('bus_pin_code')->nullable();
            $table->longText('bus_address1')->nullable();
            $table->longText('bus_address2')->nullable();
            $table->string('bus_start_year')->nullable();
            $table->string('bus_timing')->nullable();

            $table->string('bus_main_cat')->nullable();
            $table->string('bus_sub_cat')->nullable();
            $table->text('bus_product_service')->nullable();
            $table->longText('bus_desc')->nullable();

            $table->string('bus_website_url')->nullable();
            $table->string('bus_facebook_url')->nullable();
            $table->string('bus_instagram_url')->nullable();
            $table->string('bus_twitter_url')->nullable();
            $table->string('bus_video_url')->nullable();

            $table->string('bus_avg_price_range')->nullable();
            $table->string('bus_payment_mode')->nullable();
            $table->string('bus_punnaka_discount')->nullable();
            $table->string('bus_image')->nullable();
            $table->string('bus_id_proof')->nullable();

            $table->string('bus_tags')->nullable();
            $table->string('bus_location_tags')->nullable();
            $table->text('bus_meta_title')->nullable();
            $table->text('bus_meta_keyword')->nullable();
            $table->text('bus_meta_description')->nullable();
            
            $table->string('bus_payment_que_ans')->nullable();
            $table->string('bus_payment_country')->nullable();

            $table->dateTime('bus_added_time')->nullable();
            $table->dateTime('bus_changed_time')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_listing');
    }
}
