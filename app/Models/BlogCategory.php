<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blog_category';
    protected $fillable = [
        'blog_cat_id',
        'blog_cat_status',
        'blog_cat_maincat',
        'blog_cat_subcat',
        'blog_cat_title',
        'blog_cat_desc',
        'blog_cat_start_date',
        'blog_cat_start_time',
        'blog_cat_country',
        'blog_cat_state',
        'blog_cat_city',
        'blog_cat_image',
        'blog_cat_country_image',
        'blog_cat_state_image',
        'blog_cat_city_image',
        'blog_cat_subcat_image',
        'blog_cat_meta_title',
        'blog_cat_meta_desc',
        'blog_cat_meta_keyword',
        'blog_cat_admin_comment',
        'blog_cat_added_time',
        'blog_cat_changed_time'
    ];
    public $timestamps = false;
}
