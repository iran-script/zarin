<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectionPrice extends Model
{
    protected $table = 'direction_price';
    
    public function city_from() {
        return $this->belongsTo('App\City','city_id_from');
    }
    public function city_to() {
        return $this->belongsTo('App\City','city_id_to');
    }
    public function user() {
        return $this->belongsTo('App\User','user_id');

    }
}
