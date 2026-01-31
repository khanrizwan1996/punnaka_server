<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponOffer extends Model
{
    use HasFactory; 
    protected $table = 'coupon_offer';
    protected $fillable = [
        'cf_id',
        'cf_status',
        'cf_user_id',
        'cf_main_cat',
        'cf_sub_cat',
        'cf_listing_type',
        'cf_title',
        'cf_short_tagline',
        'cf_store_name',
        'cf_city',
        'cf_start_date',
        'cf_end_date',
        'cf_store_website',
        'cf_ongoing_offer',
        'cf_sort_priority',
        'cf_store_logo',
        'cf_banner_thumbnail',
        'cf_user_type',
        'cf_platform',
        'cf_highlight_options',
        'cf_term_condition',
        'cf_desc',
        'cf_admin_note',
        'cf_coupon_code_required',
        'cf_coupon_promo_code',
        'cf_coupon_discount_type',
        'cf_coupon_discount_value',
        'cf_coupon_min_order_value',
        'cf_coupon_max_discount_cap',
        'cf_coupon_login_required_redeem',
        'cf_coupon_redemption_limit',
        'cf_coupon_redirect_affiliate_url',
        'cf_offer_code_required',
        'cf_offer_type',
        'cf_offer_discount_value',
        'cf_offer_cta_buy_now_url',
        'cf_offer_valid_till',
        'cf_offer_desc',
        'cf_free_sample_freebie_type',
        'cf_free_sample_quantity',
        'cf_free_sample_eligible_users',
        'cf_free_sample_redemption_link',
        'cf_free_sample_desc',
        'cf_free_recharge_type',
        'cf_free_recharge_eligible_operators',
        'cf_free_recharge_code',
        'cf_free_recharge_claim_url',
        'cf_free_recharge_instructions',
        'cf_added_time',
        'cf_changed_time',
    ];
    public $timestamps = false;
}
