<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PressReleaseImages;
class PressRelease extends Model
{
    use HasFactory;
    protected $table = 'press_release';
    protected $fillable = [
        'pr_id',
        'pr_status',
        'pr_main_cat',
        'pr_sub_cat',
        'pr_title',
        'pr_title1',
        'pr_country',
        'pr_state',
        'pr_city',
        'pr_content_location',
        'pr_publisher',
        'pr_author',
        'pr_publish_date_time',
        'pr_modified_date_time',
        'pr_logo',
        'pr_attachment',
        'pr_video_embedded',
        'pr_meta_title',
        'pr_meta_keyword',
        'pr_meta_desc',
        'pr_desc',
        'pr_admin_comment',
        'pr_added_time',
        'pr_changed_time'
    ];
    public $timestamps = false;

    public function PressReleaseImages(){
        return $this->hasMany(PressReleaseImages::class, 'pri_press_release_id', 'pr_id');
    }

}
