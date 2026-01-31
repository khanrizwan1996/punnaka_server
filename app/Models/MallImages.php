<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MallImages extends Model
{
    use HasFactory;
    protected $table = 'mall_images';
    protected $fillable = [
        'mall_img_id',
        'mall_img_mall_id',
        'mall_img_status',
        'mall_img_path',
        'mall_img_added_time'
    ];
    public $timestamps = false;
}
