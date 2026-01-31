<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $fillable = [
        'coupon_id',
        'coupon_status',
        'coupon_user_id',
        'coupon_main_category',
        'coupon_sub_category',
        'coupon_brand_name',
        'coupon_company_name',
        'coupon_title',
        'coupon_code',
        'coupon_contact',
        'coupon_country',
        'coupon_state',
        'coupon_city',
        'coupon_website',
        'coupon_end_date_time',
        'coupon_location',
        'coupon_product_services',
        'coupon_description',
        'coupon_brand_detail',
        'coupon_brand_image',
        'coupon_image',
        'coupon_t_c',
        'coupon_start_date_time',
        'coupon_meta_title',
        'coupon_meta_keyword',
        'coupon_meta_description',
        'coupon_added_time',
        'coupon_changed_time',
    ];
    public $timestamps = false;
}
