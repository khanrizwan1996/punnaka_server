<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    protected $table = 'about_us';
    protected $fillable = [
        'about_us_id',
        'about_us_title',
        'about_us_desc',
        'about_us_image',
        'about_us_changed_time',
    ];
    public $timestamps = false;
}
