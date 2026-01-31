<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    use HasFactory;
    protected $table = 'business_listing';
    protected $fillable = [
        'bus_id',
        'bus_status',
        'bus_multiple_excel_status',
        'bus_user_id',
        'bus_plan_type',
        'bus_name',
        'bus_contact_no',
        'bus_alt_contact_no',
        'bus_email',
        'bus_state',
        'bus_country',
        'bus_city',
        'bus_pin_code',
        'bus_address1',
        'bus_address2',
        'bus_start_year',
        'bus_timing',
        'bus_main_cat',
        'bus_sub_cat',
        'bus_product_service',
        'bus_desc',
        'bus_website_url',
        'bus_facebook_url',
        'bus_instagram_url',
        'bus_twitter_url',
        'bus_video_url',
        'bus_avg_price_range',
        'bus_payment_mode',
        'bus_punnaka_discount',
        'bus_image',
        'bus_id_proof',
        'bus_tags',
        'bus_location_tags',
        'bus_meta_title',
        'bus_meta_keyword',
        'bus_meta_description',
        'bus_payment_que_ans',
        'bus_payment_country',  
        'bus_added_time',
        'bus_changed_time',
    ];
    public $timestamps = false;
    public $primaryKey='bus_id';
    
    public function BusinessListingScheduleData(){
        return $this->hasOne(BusinessListingSchedule::class,'bus_sch_business_id');
    }
}
