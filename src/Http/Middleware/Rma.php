<?php

namespace Webkul\RMA\Http\Middleware;

use Closure;

class Rma
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
        if (! core()->getConfigData('rma.settings.general.enable_rma')) {
            abort(404);
        } 

        return $next($request);
    }
}