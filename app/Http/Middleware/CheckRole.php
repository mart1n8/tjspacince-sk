<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role="")
    {
    //AK JE TO ZAVOLANE TAK MUSI BYT MINIMALNE PRIHLASENY
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Iba prihlásený užívatelia môžu pristupovať do tejto časti stránky.');
        }
        
    //HLAVNY ADMIN VSADE POVOLENIE
        if(Auth::check() && Auth::id()==1) return $next($request);
    
    //AK MA POVOLENIE DOSTATOCNE ALEBO TREBA BYT LEN PRIHLASENY
        if(Auth::check() && Auth::user()->roles>=$role && !empty($role) or Auth::check() && empty($role)) return $next($request);
        return redirect()->route('login')->with('error', 'Nemáte oprávnenie vstupovať do tejto časti stránky.');
        
    }
}
