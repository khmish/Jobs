<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class adminAuth
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
        try {
            //code...
            if(Auth::check()){

                if(Auth::user()->admin=='1'){
        
                    return $next($request);
                }
            }
            return response()->json(['status' => 'Authorization Token not found']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error']);
        }
    }
}
