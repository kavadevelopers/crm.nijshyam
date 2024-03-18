<?php

namespace App\Http\Middleware;

use App\Models\ZApiTokenModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $token = $request->header('Api-Key');
        if (!$token || !$this->isValidToken($token)) {
            return response()->json(['status' => 'Unauthorized Api-Key'],401);
        }
        return $next($request);
    }

    private function isValidToken($token): bool{
        return ZApiTokenModel::where('token', $token)->exists();
    }
}
