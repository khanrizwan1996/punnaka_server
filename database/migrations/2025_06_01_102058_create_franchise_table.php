<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise', function (Blueprint $table) {
            $table->increments('f_id');
            $table->integer('f_status')->default(0)->comment('Active: 1 , InActive: 0');
            $table->integer('f_user_id')->default(0);
            $table->string('f_main_cat', 255)->nullable();
            $table->string('f_sub_cat', 255)->nullable();
            $table->string('f_child_cat', 255)->nullable();
            $table->string('f_name', 255)->nullable();
            $table->string('f_contact_no', 50)->nullable();
            $table->string('f_email', 100)->nullable();
            $table->string('f_whatsapp_no', 50)->nullable();
            $table->string('f_company_name', 255)->nullable();
            $table->string('f_company_designation', 255)->nullable();
            $table->string('f_brand_name', 255)->nullable();
            $table->string('f_owner_name', 255)->nullable();
            $table->string('f_owner_contact_no', 50)->nullable();
            $table->string('f_owner_email', 100)->nullable();
            $table->string('f_manager_name', 255)->nullable();
            $table->string('f_manger_contact_no', 50)->nullable();
            $table->string('f_manager_email', 100)->nullable();
            $table->text('f_company_address')->nullable();
            $table->string('f_country', 100)->nullable();
            $table->string('f_state', 100)->nullable();
            $table->string('f_city', 100)->nullable();
            $table->string('f_pin_code', 30)->nullable();
            $table->string('f_landline', 50)->nullable();
            $table->string('f_business_website_url', 255)->nullable();
            $table->string('f_business_email', 100)->nullable();
            $table->string('f_business_alt_email',100)->nullable();
            $table->string('f_business_establishment_year',20)->nullable();
            $table->string('f_year_commenced_business_operations', 255)->nullable();
            $table->longText('f_business_desc')->nullable();
            $table->string('f_total_no_company_owned_outlets', 255)->nullable();
            $table->string('f_franchisee_name', 255)->nullable();
            $table->longText('f_franchisee_desc')->nullable();
            $table->string('f_year_commenced_franchising', 255)->nullable();
            $table->string('f_franchise_website_url', 255)->nullable();
            $table->string('f_total_no_franchise_outlets_opened', 255)->nullable();
            $table->string('f_current_franchisee_outlets_located_country', 100)->nullable();
            $table->string('f_current_franchisee_outlets_located_state', 100)->nullable();
            $table->string('f_current_franchisee_outlets_located_city', 100)->nullable();
            $table->string('f_marketing_materials_available', 255)->nullable();
            $table->string('f_franchise_grant_unit_exclusive_territorial_rights', 255)->nullable();
            $table->string('f_performance_guarantees_unit_franchisees', 255)->nullable();
            $table->string('f_marketing_advertising_levies_payable_franchisor', 255)->nullable();
            $table->string('f_amount_investment_franchisee', 255)->nullable();
            $table->string('f_franchisee_brand_fee', 255)->nullable();
            $table->string('f_multi_Units_brand_fee', 255)->nullable();
            $table->string('f_royalty_commission', 255)->nullable();
            $table->string('f_return_investment_anticipated', 255)->nullable();
            $table->string('f_expected_payback_period_capital_franchised_unit_no', 50)->nullable();
            $table->string('f_expected_payback_period_capital_franchised_unit_month', 100)->nullable();
            $table->string('f_expected_payback_period_capital_franchised_unit_year', 100)->nullable();
            $table->string('f_further_investment_requirements', 255)->nullable();
            $table->string('f_provide_aid_financing', 255)->nullable();
            $table->string('f_begin_expanding_internationally', 255)->nullable();
            $table->string('f_begin_expanding_internationally_country', 100)->nullable();
            $table->string('f_franchise_opportunity', 255)->nullable();
            $table->string('f_preferred_location_franchise_outlet', 255)->nullable();
            $table->string('f_floor_area_requirements_franchisee', 255)->nullable();
            $table->string('f_franchisee_arrange_furnish_premises', 255)->nullable();
            $table->string('f_offer_site_selection_assistance', 255)->nullable();
            $table->string('f_franchise_operation_instructions_available', 255)->nullable();
            $table->string('f_franchisee_training_conducted', 255)->nullable();
            $table->string('f_field_assistance_available_franchises', 255)->nullable();
            $table->string('f_office_support_franchisee_opening_franchise', 255)->nullable();
            $table->string('f_it_systems_presently_included_franchise', 255)->nullable();
            $table->string('f_standard_franchise_agreement', 255)->nullable();
            $table->string('f_franchise_contract_last', 255)->nullable();
            $table->string('f_franchise_contract_last_value', 255)->nullable();
            $table->string('f_franchise_contract_renewable', 255)->nullable();
            $table->string('f_company_logo', 255)->nullable();
            $table->string('f_company_image', 255)->nullable();
            $table->string('f_franchise_logo', 255)->nullable();
            $table->string('f_franchise_image', 255)->nullable();
            $table->string('f_franchise_brochure', 255)->nullable();
            $table->string('f_corporate_video_url', 255)->nullable();
            $table->string('f_facebook_url', 255)->nullable();
            $table->string('f_twitter_url', 255)->nullable();
            $table->string('f_instagram_url', 255)->nullable();
            $table->string('f_youtube_url', 255)->nullable();
            $table->dateTime('fc_added_time')->nullable();
            $table->dateTime('fc_changed_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise');
    }
}
