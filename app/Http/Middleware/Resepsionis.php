<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Resepsionis
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
        //return $next($request);
        $user_level = Session::get('user_level');

        if($user_level !== 'resepsionis'){
            return redirect('/')->with('alert-danger','Kamu sudah logout');
        }else{
            return $next($request);
        }
    }
}
