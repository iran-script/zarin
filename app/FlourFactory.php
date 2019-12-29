<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlourFactory extends Model
{
    protected $table = 'flour_factory';
    public function city() {
        return $this->belongsTo('App\City','city_id');
    }

}
