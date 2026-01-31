<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    use HasFactory;
    protected $table = 'blog_comments';
    protected $fillable = [
        'bc_id',
        'bc_status',
        'bc_blog_id',
        'bc_user_id',
        'bc_subject',
        'bc_desc',
        'created_at',
    ];
    public $timestamps = false;
}
