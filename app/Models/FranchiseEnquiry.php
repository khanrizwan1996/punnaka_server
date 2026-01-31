<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseEnquiry extends Model
{
    use HasFactory;
    protected $table = 'franchise_enquiry';
    protected $fillable = [
    'fe_id',
    'fe_franchise_id',
    'fe_user_id',
    'fe_name',
    'fe_email',
    'fe_contact_no',
    'fe_country',
    'fe_state',
    'fe_city',
    'fe_investment_range',
    'fe_address',
    'fe_added_timestamp'
    ];
    public $timestamps = false;

}
