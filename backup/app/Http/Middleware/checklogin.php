<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checklogin
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
        if ($request->session()->exists('admin')) { 
            return $next($request);     
        } else {
            return redirect('login');
            //return redirect()->route('login'); 
        }         
    }
}
                                 
     