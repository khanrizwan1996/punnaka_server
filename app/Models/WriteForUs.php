<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriteForUs extends Model
{
    use HasFactory;
    protected $table = 'write_for_us';
    protected $fillable = [
    'wfu_id',
    'wfu_status',
    'wfu_user_name',
    'wfu_user_email',
    'wfu_user_contact_no',
    'wfu_message',
    'wfu_added_time',
    'wfu_changed_time'
    ];
    public $timestamps = false;
}
