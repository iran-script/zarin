<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RoleAdmin
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
            return response()->json(['error'=>'not accesss'], 401);

    }
}
