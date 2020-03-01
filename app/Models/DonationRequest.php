<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_age', 'blood_type_id', 'bags_num', 'hospital_name',
    'hospital_address', 'city_id', 'phone', 'notes','client_id');
    //'latitude', 'longtitude'

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
