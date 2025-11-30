<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOrgAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'org_admin' && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized - org-admin only'], 403);
        }

        return $next($request);
    }
}
