<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class websiteContent extends Model
{
    use HasFactory;
    protected $table = 'website_content';
    protected $fillable = [
        'wc_id',
        'wc_header_logo',
        'wc_footer_logo',
        'wc_footer_content',
        'wc_contact_no',
        'wc_email_address',
        'wc_address',
        'wc_fb_link',
        'wc_insta_link',
        'wc_pinterest_link',
        'wc_quora_link',
        'wc_whatsapp_link',
        'wc_term_condition',
        'wc_privacy_policy',
        'wc_update_time',
    ];
    public $timestamps = false;
}
