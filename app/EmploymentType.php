<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    //
   protected $table = 'employmenttype';
   protected $hidden = [
        'created_at','updated_at'
    ];

    
}
