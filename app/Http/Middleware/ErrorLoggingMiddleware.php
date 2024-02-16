<?php

namespace App\Http\Middleware;

use App\Model\ErrorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErrorLoggingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 400 && $statusCode < 600) {
            ErrorLog::create([
                'ip' => $request->ip(),
                'log_date' => now(),
                'user_agent' => $request->userAgent(),
                'request_endpoint' => $request->fullUrl(),
                'response_code' => $response->getStatusCode(),
                'response_time' => microtime(true) - LARAVEL_START,
                'request_body' => json_encode($request->all()),
                'response_body' => $response->exception->getMessage(),
            ]);
        }

        return $response;

    }
}
