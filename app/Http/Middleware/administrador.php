<?php

namespace App\Http\Middleware;
use Closure;

class administrador {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        try {
            $user = \Auth::user();

            if ($user->id_perfil != 2) {
                return redirect("/ogin");
            }

            return $next($request);

        } catch (\Exception $ex) {
            return redirect('/login');
        }
        
    }

}
