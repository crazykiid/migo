<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class RedirectLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        if(($path == "login" || $path == "create" ) && empty(Session::get('user_id')))
        {
            return $next($request);
        }
        elseif(($path == "login" || $path == "create" ) && Session::get('user_id'))
        {
            return redirect('/'); 
        }
        else
        {
            return $next($request);
        }
    }
}
