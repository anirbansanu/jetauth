<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $u_id = Auth::user()->id?Auth::user()->id:false;
        if($u_id)
        {
            $utype = Auth::user()->usertype;
            if(!$utype)
            return $next($request);
            else
            {
                return redirect('/redirect');
            }
        }
        else{
            return redirect('/login');
        }
    }
}
