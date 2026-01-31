<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMain extends Model
{
    use HasFactory;
    protected $table = 'category_main';
    protected $fillable = [
        'cat_main_id',
        'cat_main_type',
        'cat_main_name',
        'cat_main_status',
        'cat_main_added_time',
        'cat_main_changed_time',
    ];
    public $timestamps = false;
}
