<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model
{
    use HasFactory;
    protected $table = 'category_sub';
    protected $fillable = [
        'cat_sub_id',
        'cat_sub_main_id',
        'cat_sub_status',
        'cat_sub_name',
        'cat_sub_image',
        'cat_sub_added_time',
        'cat_sub_changed_time'
    ];
    public $timestamps = false;
}
