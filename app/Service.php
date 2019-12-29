<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table= 'services'; 
    protected $fillable=['price'];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function province() {
        return $this->belongsTo('App\City','province_id');
    }
    public function city() {
        return $this->belongsTo('App\City','city_id');
    }
    public function area() {
        return $this->belongsTo('App\City','area_id');
    }
    public function flourfactory() {
        return $this->belongsTo('App\FlourFactory','flourfactory_id');
    } 
    public function driver() {
        return $this->belongsTo('App\Drivers','driver_id');
    } 
    public function navy() {
        return $this->belongsTo('App\Navy','navy_id');
    } 
    public function orders()
	{
	    return $this->hasMany('App\Orders' , 'service_id');
	}
}
