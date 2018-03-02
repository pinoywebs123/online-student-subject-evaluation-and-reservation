<?php

namespace App\Http\Middleware\user;

use Closure;

use Auth;
class admincheck
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
        }else{
            if(Auth::user()->role_id != 1){
                return abort(404);
            }
        }
        

       
        return $next($request);
    }
}
