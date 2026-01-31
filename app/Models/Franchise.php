<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;
    protected $table = 'franchise';
    protected $fillable = [
    'f_id',
    'f_status',
    'f_user_id',
    'f_name',
    'f_contact_no',
    'f_alt_contact_no',
    'f_email',
    'f_website',
    'f_main_cat',
    'f_sub_cat',
    'f_child_cat',
    'f_brand_name',
    'f_company_name',
    'f_business_year_established',
    'f_business_type',
    'f_franchise_website_url',
    'f_business_desc',
    'f_country',
    'f_state',
    'f_city',
    'f_pin_code',
    'f_franchisee_address',
    'f_franchisee_type',
    'f_franchisee_year_established',
    'f_total_investment',
    'f_franchise_fee',
    'f_royalty_fee',
    'f_marketing_fee',
    'f_total_company_owned_outlets',
    'f_total_franchise_outlets_opened',
    'f_other_investment_requirements',
    'f_franchisee_desc',
    'f_available_in_india',
    'f_international_expansion',
    'f_training_provided',
    'f_training_duration',
    'f_financing_aid',
    'f_site_selection_assistance',
    'f_head_office_support_open',
    'f_it_systems_included',
    'f_performance_guarantee',
    'f_expected_roi',
    'f_payback_period',
    'f_franchise_term_duration',
    'f_term_renewable',
    'f_type_property_required',
    'f_minimum_area_required',
    'f_property_location_preference',
    'f_who_will_furnish_premises',
    'f_company_logo',
    'f_franchise_brochure',
    'f_business_registration_certificate',
    'f_franchise_disclosure_document',
    'f_products_services',
    'f_corporate_video_url',
    'f_facebook_url',
    'f_twitter_url',
    'f_instagram_url',
    'f_youtube_url',
    'f_why_choose_you',
    'f_success_story',
    'f_added_time',
    'f_changed_time'
    ];
    public $timestamps = false;
}
