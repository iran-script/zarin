<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'depositing_receipt';
    protected $fillable = [
        'baker_smart_id','city_id','flour_id','flourfactory_id','user_id','deposit_date','flour_type','number_bags','branch_code','type','smart_number'
    ];
    public function baker() {
        return $this->belongsTo('App\Bakers','baker_smart_id','smart_id');
    }
    public function city() {
        return $this->belongsTo('App\City','city_id');
    }
    public function flourfactory() {
        return $this->belongsTo('App\FlourFactory','flourfactory_id','smart_id');
    }


}
