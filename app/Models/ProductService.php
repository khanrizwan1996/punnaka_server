<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    use HasFactory;
    protected $table = 'product_service';
    protected $fillable = [
    'ps_id',
    'ps_status',
    'ps_user_id',
    'ps_main_cat',
    'ps_sub_cat',
    'ps_title',
    'ps_listing_type',
    'ps_pricing_type',
    'ps_currency',
    'ps_price_range',
    'ps_discount',
    'ps_tax',
    'ps_country',
    'ps_state',
    'ps_city',
    'ps_service_area',
    'ps_availability_date_time',
    'ps_additional_options',
    'ps_size',
    'ps_color',
    'ps_return_policy',
    'ps_cancellation_policy',
    'ps_add_ons',
    'ps_stock',
    'ps_sku',
    'ps_shipping_option',
    'ps_image',
    'ps_video_url',
    'ps_brochure',
    'ps_contact_name',
    'ps_contact_number',
    'ps_contact_email',
    'ps_contact_whatsapp',
    'ps_website_url',
    'ps_portfolio_url',
    'ps_facebook_url',
    'ps_instagram_url',
    'ps_twitter_url',
    'ps_other_url',
    'ps_visibility',
    'ps_featured_listing',
    'ps_expiry_date',
    'ps_tags_keywords',
    'ps_short_description',
    'ps_detail_description',
    'ps_added_time',
    'ps_changed_time'
    ];
    public $timestamps = false;
}
