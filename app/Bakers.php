<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakers extends Model
{
    //
    protected $table = 'bakers';

    public function bakingtype() {
        return $this->belongsTo('App\BakingType','bakingtype_id');
    }

    public function city() {
        return $this->belongsTo('App\City','city_id');
    }

     public function zone() {
        return $this->belongsTo('App\City','zone_id');
    }
}
