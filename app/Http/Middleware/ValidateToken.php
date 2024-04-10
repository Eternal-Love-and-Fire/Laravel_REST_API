<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $validToken = DB::table('tokens')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->where('used', false)
            ->first();

        if (!$validToken) {
            return response()->json(['error' => 'Invalid or expired token'], 401);
        }

        DB::table('tokens')
            ->where('token', $token)
            ->update(['used' => true]);

        return $next($request);
    }
}
