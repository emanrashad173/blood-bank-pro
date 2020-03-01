<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('play_store_url', 'app_store_url',	'title_mob_app','content_mob_app','notification_text', 'about_app','intro_app', 'who_we_are_text', 'phone', 'email', 'fb_link', 'tw_link', 'insta_link', 'youtube_link', 'gmail_link', 'whats_num');

}
