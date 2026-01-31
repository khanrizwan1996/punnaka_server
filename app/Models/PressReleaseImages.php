<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressReleaseImages extends Model
{
    use HasFactory;
    protected $table = 'press_release_images';
    protected $fillable = [
        'pri_id',
        'pri_press_release_id',
        'pri_path',
        'pri_added_time'
    ];
    public $timestamps = false;
}
