<?php

namespace App\Http\Middleware;

use App\Facade\Tenant as FacadesTenant;
use Closure;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantCheack
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

        $host = $request->getHost();

        $tenant = Tenant::where('domain',$host)->first();

        FacadesTenant::switchTenant($tenant);

        return $next($request);
    }
}
