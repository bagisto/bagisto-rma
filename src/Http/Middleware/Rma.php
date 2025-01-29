<?php

namespace Webkul\RMA\Http\Middleware;

use Closure;

class Rma
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Tenant Disabled
         */
        abort_if (! core()->getConfigData('sales.rma.setting.enable_rma'), 404);

        return $next($request);
    }
}