<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Database\Models\Domain;

class InitializeTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenantSlug = $request->header('X-Tenant');

        if ($tenantSlug) {
            $domain = Domain::where('tenant_id', $tenantSlug)->first();

            if (!$domain) {
                return response()->json([
                    'message' => 'Tenant not found.'
                ], 404);
            }

            // Initialize tenant context BEFORE Sanctum tries to verify the token
            tenancy()->initialize($domain->tenant['id']);
        }

        return $next($request);
    }
}
