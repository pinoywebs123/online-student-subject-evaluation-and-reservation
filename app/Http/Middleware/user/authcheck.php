<?php

namespace App\Http\Middleware\user;

use Closure;
use Auth;
class authcheck
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
        if(Auth::check()){
            if(Auth::user()->role_id == 1){
                return redirect()->route('admin_main');
            }else if(Auth::user()->role_id == 2){
                return redirect()->route('student_main');
            }
        }
        return $next($request);
    }
}
