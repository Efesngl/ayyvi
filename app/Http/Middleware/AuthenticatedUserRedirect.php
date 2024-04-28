<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedUserRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeList=[
            "login",
            "register"
        ];
        if($request->user()==null){
            return redirect()->route("login");
        }
        if($request->user()!=null && in_array(Route::currentRouteName(),$routeList)){
            return redirect()->route("home");
        }
        return $next($request);
    }
}
