<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    protected $table = 'newsletters';
    protected $fillable = [
        'nl_id',
        'nl_email',
        'nl_added_time',
    ];
    public $timestamps = false;
}
