<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseLocationDetail extends Model
{
    use HasFactory;
    protected $table = 'franchise_location_detail';
    protected $fillable = [
    'fld_id',
    'fld_franchise_id',
    'fld_country',
    'fld_state',
    'fld_city',
    'fld_added_timestamp',
    'fld_changed_timestamp'
    ];
    public $timestamps = false;
}
