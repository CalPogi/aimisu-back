<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogOptionsRequests
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            return response('', 204)
                ->header('Access-Control-Allow-Origin', $request->header('Origin') ?? '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers') ?? '*')
                ->header('Access-Control-Allow-Credentials', 'true');
        }

        $response = $next($request);

        return $response->header('Access-Control-Allow-Origin', $request->header('Origin') ?? '*')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
