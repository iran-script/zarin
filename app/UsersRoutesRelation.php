<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRoutesRelation extends Model
{
	protected $fillable = [
        'route_id','user_id'
    ];
    protected $table= 'users_routes_relation';  
    //
}
