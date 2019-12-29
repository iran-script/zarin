<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navy extends Model
{
    protected $table= 'navy';
    public function employmenttype() {
        return $this->belongsTo('App\EmploymentType','employmenttype_id');
    }
    public function camiontype() {
        return $this->belongsTo('App\CamionTypes','camiontype_id');
    }
     public function driver() {
        return $this->belongsTo('App\Drivers','driver_id');
    }
}
