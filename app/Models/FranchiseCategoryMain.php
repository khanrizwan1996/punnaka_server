<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseCategoryMain extends Model
{
    use HasFactory;
    protected $table = 'franchise_category_main';
    protected $fillable = [
    'fcm_id',
    'fcm_name',
    'fcm_status',
    'fcm_added_time',
    'fcm_changed_time'
    ];
    public $timestamps = false;
}
