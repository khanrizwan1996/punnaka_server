<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListingSchedule extends Model
{
    use HasFactory;
    protected $table = 'business_listing_schedule';
    public $primaryKey='bus_sch_id';
    protected $fillable = [
        'bus_sch_id',
        'bus_sch_business_id',
        'bus_sch_sun_status',
        'bus_sch_sun_start',
        'bus_sch_sun_end',
        'bus_sch_mon_status',
        'bus_sch_mon_start',
        'bus_sch_mon_end',
        'bus_sch_tue_status',
        'bus_sch_tue_start',
        'bus_sch_tue_end',
        'bus_sch_wed_status',
        'bus_sch_wed_start',
        'bus_sch_wed_end',
        'bus_sch_thu_status',
        'bus_sch_thu_start',
        'bus_sch_thu_end',
        'bus_sch_fri_status',
        'bus_sch_fri_start',
        'bus_sch_fri_end',
        'bus_sch_sat_status',
        'bus_sch_sat_start',
        'bus_sch_sat_end',
        'bus_sch_sun_time_status',
        'bus_sch_mon_time_status',
        'bus_sch_tue_time_status',
        'bus_sch_wed_time_status',
        'bus_sch_thu_time_status',
        'bus_sch_fri_time_status',
        'bus_sch_sat_time_status',
        'bus_sch_added_time',
        'bus_sch_changed_time'
    ];
    public $timestamps = false;
}
