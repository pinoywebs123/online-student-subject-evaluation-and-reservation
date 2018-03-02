<?php

namespace App\Http\Middleware\user;

use Closure;
use Auth;
class staffcheck
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
        if(!Auth::check()){
            return redirect('/');
        }
        if(Auth::user()->status_id == 0){
            return abort(404);
        }

        if(Auth::user()->role_id != 3 ){
            return abort(404);
        }
        return $next($request);
    }
}
