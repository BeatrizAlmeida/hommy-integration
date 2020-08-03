<?php

namespace App\Http\Middleware;
use App\Http\Controllers\RepublicController;
use App\Republic;
use Closure;
use  Auth;

class DeleteRepublic
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
        $user = Auth::user()->id;
        $republic = Republic::findOrFail($request->id);
        if($republic->user_id == $user){
            return $next($request);
        }
        else{
            return response()->json(['Você não é o dono dessa república, não pode deletá-la.']);
        }
    }
}
