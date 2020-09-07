<?php

namespace App\Http\Middleware;

use closure;
use Illuminate\Support\Facades\Auth;

class Manager
{

    public function handle($request, closure $next)
    {    
        if(Auth::user()->admin_role_id == 4)
        {
           return $next($request); 
        }
        else
        {
            return redirect()->route('user_dashboard');
        }
        
    }
}