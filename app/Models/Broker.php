<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state', 'pancard_number', 'aadhar_number', 'mobile_number'];

    public function bankDetail()
    {
        return $this->hasOne(BrokerBankDetail::class);
    }

      public function stateName()
    {
        return $this->belongsTo(State::class, 'state', 'id_state');  
    }

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city', 'id_city');  
    }
}