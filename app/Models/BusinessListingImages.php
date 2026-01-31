<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListingImages extends Model
{
    use HasFactory;
    protected $table = 'business_listing_images';
    protected $fillable = [
        'bus_img_id',
        'bus_img_business_id',
        'bus_img_status',
        'bus_img_type',
        'bus_img_path',
        'bus_img_added_time'
    ];
    public $timestamps = false;
}
