<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //recive el parametro $role
    
    public function handle($request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);

              //if (auth()->user()->role === $role) 
        if (auth()->user()->hasRoles($roles)) 
        {
            return $next($request);
        }
       

       
       return redirect('/');
    }

    // public function handle($request, Closure $next, $role)
    // {
    //     //if (auth()->user()->role === $role) 
    //     if (auth()->user()->hasRoles($role)) 
    //     {
             
    //          return $next($request);
    //     }
    //    return redirect('/');
    // }
}
