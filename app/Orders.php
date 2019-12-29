<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table= 'orders'; 
    // protected $fillable = [
    //     'depo_id', 'baker_id', 'service_id','navy_id','factory_id','verify_order','print','driver_id'
    // ];
    public function deposit() {
        return $this->belongsTo('App\Deposit','depo_id');
    }
    public function baker() {
        return $this->belongsTo('App\Bakers','baker_id');
    }
    public function service() {
        return $this->belongsTo('App\Service','service_id');
    }
    public function navy() {
        return $this->belongsTo('App\Navy','navy_id');
    } 
    public function driver() {
        return $this->belongsTo('App\Drivers','driver_id');
    } 
    public function flourfactory() {
        return $this->belongsTo('App\FlourFactory','factory_id');
    } 


}
