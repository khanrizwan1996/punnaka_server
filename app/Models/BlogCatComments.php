<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCatComments extends Model
{
    use HasFactory;
    protected $table = 'blog_cat_comments';
    protected $fillable = [
        'blogcat_comment_id',
        'blogcat_comment_status',
        'blogcat_comment_blog_id',
        'blogcat_comment_user_id',
        'blogcat_comment_subject',
        'blogcat_comment_desc',
        'blogcat_comment_added_time',
    ];
    public $timestamps = false;
}
