<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = [
        'blog_id',
        'blog_status',
        'blog_maincat_name',
        'blog_title',
        'blog_detail',
        'blog_image',
        'blog_meta_title',
        'blog_meta_keword',
        'blog_meta_description',
        'blog_admin_comment',
        'blog_added_timestamp',
        'blog_changed_timestamp'
    ];
    public $timestamps = false;
}
