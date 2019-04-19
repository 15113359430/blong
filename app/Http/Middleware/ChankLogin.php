<?php

namespace App\Http\Middleware;

use Closure;

class ChankLogin
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
        if(session('name')){
            return $next($request);
        }else{
            return redirect('admin/login');
        }
        
    }
}
