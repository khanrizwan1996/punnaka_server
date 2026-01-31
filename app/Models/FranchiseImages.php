<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseImages extends Model
{
    use HasFactory;
    protected $table = 'franchise_images';
    protected $fillable = [
    'fi_id',
    'fi_franchise_id',
    'fi_path',
    'fi_added_time'
    ];
    public $timestamps = false;
}
