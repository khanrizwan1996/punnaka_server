<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListingPayment extends Model
{
    use HasFactory;
    protected $table = 'business_listing_payments';
    protected $fillable = [
        'bus_pay_id',
        'bus_pay_status',
        'bus_pay_random_id',
        'bus_pay_business_id',
        'bus_pay_payment_id',
        'bus_pay_user_name',
        'bus_pay_user_email',
        'bus_pay_user_contact_no',
        'bus_pay_user_business_name',
        'bus_pay_plan_type',
        'bus_pay_payment_currency',
        'bus_pay_amount',
        'bus_pay_added_time',
        'bus_pay_changed_time',
        'bus_pay_user_id'

    ];
    public $timestamps = false;
}
