<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'brand_id',
        'brand_mall_id',
        'brand_status',
        'brand_name',
        'brand_contact_no',
        'brand_email',
        'brand_main_cat',
        'brand_sub_cat',
        'brand_prodct_services',
        'brand_store_type',
        'brand_floor',
        'brand_area',
        'brand_location',
        'brand_city',
        'brand_store_timings',
        'brand_store_weekend_timings',
        'brand_store_weekday_timings',
        'brand_logo',
        'brand_desc',
        'brand_meta_title',
        'brand_meta_keyword',
        'brand_meta_description',
        'brand_added_time',
        'brand_changed_time'
    ];
    public $timestamps = false;
}
