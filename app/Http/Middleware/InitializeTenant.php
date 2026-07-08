<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;

class InitializeTenant
{
    public function handle(Request $request, Closure $next)
    {
        $tenantSlug = $request->header('X-Tenant');

        if (!$tenantSlug) {
            return response()->json([
                'message' => 'Tenant header missing.'
            ], 400);
        }

        $domain = Domain::where('tenant_id', $tenantSlug)->first();

        if (!$domain) {
            return response()->json([
                'message' => 'Tenant not found.'
            ], 404);
        }

        tenancy()->initialize($domain->tenant);

        return $next($request);
    }
}
