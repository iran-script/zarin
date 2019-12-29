<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UsersRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
             $roles= Auth::user()->roles->where('role_name','admin');
            if(!$roles->isEmpty())
            {
           return $next($request);
            }
            $routes= Auth::user()->routes->where('name',\Request::route()->getName());
            if(!$routes->isEmpty() || \Request::route()->getName() == 'getroutelist')
            {
            return $next($request);
            }
            return response()->json(['data' => [null] , 'massage' => 'شما مجوز دسترسی به این قسمت را ندارید.' , 'status' => 401], 401);


    }
}
