<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $fillable = [
        'banner_id',
        'banner_title',
        'banner_status',
        'banner_short_desc',
        'banner_image',
        'banner_added_time',
        'banner_changed_time',
    ];
    public $timestamps = false;
}
