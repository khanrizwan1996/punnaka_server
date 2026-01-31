<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;
    protected $table = 'plan_detail';
    protected $fillable = [
    'pd_id',
    'pd_plan_id',
    'pd_description',
    'pd_added_time',
    'pd_changed_time'
    ];
    public $timestamps = false;
}
