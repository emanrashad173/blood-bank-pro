<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;
    protected $guard = 'clients';
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'password', 'name', 'email', 'dob',  'last_donation_date', 'blood_type_id',
    'city_id','api_token','pin_code');

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function donationRequests()
    {
            return $this->hasMany('App\Models\DonationRequest');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }
    protected $hidden = [
        'password',
    ];
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
}
