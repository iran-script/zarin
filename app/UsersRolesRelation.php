<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRolesRelation extends Model
{
	protected $fillable = [
        'role_id','user_id'
    ];
    protected $table= 'users_roles_relation';
}
