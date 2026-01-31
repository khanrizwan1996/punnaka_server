<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseCategoryChild extends Model
{
    use HasFactory;
    protected $table = 'franchise_category_child';
    protected $fillable = [
    'fcc_id',
    'fcc_cat_main_id',
    'fcc_cat_sub_id',
    'fcc_name',
    'fcc_status',
    'fcc_added_time',
    'fcc_changed_time'
    ];
    public $timestamps = false;
}
