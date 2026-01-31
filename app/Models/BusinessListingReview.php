<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListingReview extends Model
{
    use HasFactory;
    protected $table = 'business_listing_review';
    protected $fillable = [
        'blr_id',
        'blr_business_listing_id',
        'blr_user_id',
        'blr_status',
        'blr_star',
        'blr_review',
        'blr_adde_time'
    ];
    public $timestamps = false;
}
