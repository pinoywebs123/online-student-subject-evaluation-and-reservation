<?php

namespace App\Http\Middleware\user;

use Closure;

use Auth;
class studentcheck
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
            return redirect()->route('login');
        }

        if(Auth::user()->status_id == 5){
            Auth::logout();
            return abort(404);
        }
        
        if(Auth::user()->status_id == 0){
            return abort(404);
        }

        if(Auth::user()->role_id != 2 ){
            return abort(404);
        }
       
        return $next($request);
    }
}
