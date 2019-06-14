<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use Config;

class Lanq
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
        if(Session::has('locale')){
            $lanq=Session::get('locale', Config::get('app.locale'));
        }
        else{
            $lanq='ar';
        }
        App::setLocale($lanq);
        return $next($request);
    }
}
