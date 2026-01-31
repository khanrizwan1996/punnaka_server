<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
    'offer_id',
    'offer_status',
    'offer_user_id',
    'offer_mall_id',
    'offer_brand_id',
    'offer_main_category',
    'offer_sub_category',
    'offer_title',
    'offer_country',
    'offer_state',
    'offer_city',
    'offer_start_date',
    'offer_start_time',
    'offer_end_date',
    'offer_end_time',
    'offer_detail',
    'offer_image',
    'offer_company_name',
    'offer_brand_image',
    'offer_t_c',
    'offer_meta_title',
    'offer_meta_keyword',
    'offer_meta_description',
    'offer_added_timestamp',
    'offer_changed_timestamp',
    ];
    public $timestamps = false;
}
