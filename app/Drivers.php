<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
     protected $table= 'drivers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function bank() {
        return $this->belongsTo('App\Bank','bank_id');
    }
    
    public function employmenttype() {
        return $this->belongsTo('App\EmploymentType','employmenttype_id');
    }


    public function navy() {
        return $this->belongsTo('App\Navy','id','driver_id');
    }

    public function services() {
        return $this->hasmany('App\Service','driver_id');
    }
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
