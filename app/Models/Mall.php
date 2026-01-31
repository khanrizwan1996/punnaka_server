<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    protected $table = 'mall';
    protected $fillable = [
        'mall_id',
        'mall_status',
        'mall_name',
        'mall_contact_no',
        'mall_email',
        'mall_desc',
        'mall_location',
        'mall_city',
        'mall_opening_date',
        'mall_timing',
        'mall_store_timing',
        'mall_website_link',
        'mall_logo',
        'mall_meta_title',
        'mall_meta_keyword',
        'mall_meta_description',
        'mall_added_time',
        'mall_changed_time'
    ];
    public $timestamps = false;
}
