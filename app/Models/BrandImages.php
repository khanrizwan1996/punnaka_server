<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandImages extends Model
{
    use HasFactory;
    protected $table = 'brand_images';
    protected $fillable = [
        'brand_img_id',
        'brand_img_brand_id',
        'brand_img_status',
        'brand_img_path',
        'brand_img_added_time'
    ];
    public $timestamps = false;
}
