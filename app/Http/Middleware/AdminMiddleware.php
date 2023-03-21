<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth()->user()->getIsAdminAttribute()){
            return $next($request);
        }
        else{
            return redirect()->route('landing');
        }
    }
}
