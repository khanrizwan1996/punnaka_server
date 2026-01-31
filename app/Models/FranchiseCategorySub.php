<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseCategorySub extends Model
{
    use HasFactory;
    protected $table = 'franchise_category_sub';
    protected $fillable = [
    'fcs_id',
    'fcs_cat_main_id',
    'fcs_name',
    'fcs_status',
    'fcs_added_time',
    'fcs_changed_time'
    ];
    public $timestamps = false;
}
