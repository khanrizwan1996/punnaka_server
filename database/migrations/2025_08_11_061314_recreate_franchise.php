<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateFranchise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('franchise');
        if (!Schema::hasTable('franchise')) {
        Schema::create('franchise', function (Blueprint $table) {
            $table->increments('f_id');
            $table->integer('f_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->integer('f_user_id')->default(0);
            $table->string('f_name', 255)->nullable();
            $table->string('f_contact_no', 50)->nullable();
            $table->string('f_email', 100)->nullable();
            $table->string('f_website', 100)->nullable();

            $table->string('f_main_cat', 255)->nullable();
            $table->string('f_sub_cat', 255)->nullable();
            $table->string('f_child_cat', 255)->nullable();
            $table->string('f_brand_name', 255)->nullable();
            $table->string('f_company_name', 255)->nullable();
            $table->string('f_business_year_established',100)->nullable();
            $table->string('f_business_type',100)->nullable();
            $table->string('f_franchise_website_url', 100)->nullable();
            $table->longText('f_business_desc')->nullable();
            
            $table->string('f_country', 100)->nullable();
            $table->string('f_state', 100)->nullable();
            $table->string('f_city', 100)->nullable();
            $table->string('f_pin_code', 30)->nullable();
            $table->text('f_franchisee_address')->nullable();
            
            $table->string('f_franchisee_type', 100)->nullable();
            $table->string('f_franchisee_year_established',100)->nullable();
            $table->string('f_total_investment',255)->nullable();
            $table->string('f_franchise_fee',255)->nullable();
            $table->string('f_royalty_fee',255)->nullable();
            $table->string('f_marketing_fee',255)->nullable();
            $table->string('f_total_company_owned_outlets', 255)->nullable();
            $table->string('f_total_franchise_outlets_opened', 255)->nullable();
            $table->string('f_other_investment_requirements', 255)->nullable();
            $table->longText('f_franchisee_desc')->nullable();

            $table->string('f_available_in_india', 100)->nullable();
            $table->string('f_international_expansion', 100)->nullable();
            $table->string('f_training_provided', 100)->nullable();
            $table->string('f_training_duration', 100)->nullable();
            $table->string('f_financing_aid', 100)->nullable();
            $table->string('f_site_selection_assistance', 100)->nullable();
            $table->string('f_head_office_support_open', 100)->nullable();
            $table->string('f_it_systems_included', 100)->nullable();

            $table->string('f_performance_guarantee', 100)->nullable();
            $table->string('f_expected_roi', 255)->nullable();
            $table->string('f_payback_period', 255)->nullable();
            $table->string('f_franchise_term_duration', 100)->nullable();
            $table->string('f_term_renewable', 100)->nullable();
            $table->string('f_type_property_required', 100)->nullable();
            $table->string('f_minimum_area_required', 255)->nullable();
            $table->string('f_property_location_preference', 255)->nullable();
            $table->string('f_who_will_furnish_premises', 100)->nullable();

            $table->string('f_company_logo', 255)->nullable();
            $table->string('f_franchise_brochure', 255)->nullable();
            $table->string('f_business_registration_certificate', 255)->nullable();
            $table->string('f_franchise_disclosure_document', 255)->nullable();
            $table->string('f_products_services', 255)->nullable();

            $table->string('f_corporate_video_url', 255)->nullable();
            $table->string('f_facebook_url', 255)->nullable();
            $table->string('f_twitter_url', 255)->nullable();
            $table->string('f_instagram_url', 255)->nullable();
            $table->string('f_youtube_url', 255)->nullable();

            $table->text('f_why_choose_you')->nullable();
            $table->text('f_success_story')->nullable();

            $table->dateTime('fc_added_time')->nullable();
            $table->dateTime('fc_changed_time')->nullable();
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
      // Schema::dropIfExists('franchise');
    }
}
