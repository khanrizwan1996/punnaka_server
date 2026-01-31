<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = [
    'p_id',
    'p_title',
    'p_type',
    'p_short_desc',
    'p_price',
    'p_status',
    'p_added_time',
    'p_changed_time'
    ];
    public $timestamps = false;
}
