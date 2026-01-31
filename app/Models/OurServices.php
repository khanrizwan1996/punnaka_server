<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurServices extends Model
{
    use HasFactory;
    
    protected $table = 'service_enquiry';
    protected $fillable = [
    'se_id',
    'se_status',
    'se_user_name',
    'se_user_email',
    'se_user_contact_no',
    'se_message',
    'se_services',
    'se_added_time',
    'se_changed_time'
    ];
    public $timestamps = false;
}
