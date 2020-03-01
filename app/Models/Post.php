<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id');
    protected $appends = ['is_favourite'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }


   //getif is_favourite

    public function getIsFavouriteAttribute()
    {
      $client = auth('api')->user() ? auth('api')->user() : auth('client-web')->user();
      if (!$client) {
        return false;
      }
      $check = $client->posts()->where('posts.id',$this->id)->first();
      if ($check) {
        return true;
      }
      else
     {
        return false;
     }
    }


}
