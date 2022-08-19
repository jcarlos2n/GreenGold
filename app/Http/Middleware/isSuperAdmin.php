<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class isSuperAdmin
{
    const ROLE_SUPER_ADMIN = 3;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $isSuperAdmin = $user->roles->contains(self::ROLE_SUPER_ADMIN);

        if (!$isSuperAdmin) {
            return response()->json([
                'success' => false,
                'message' => 'This route doesnt exists'
            ],404);
        }
        return $next($request);
    }
}
