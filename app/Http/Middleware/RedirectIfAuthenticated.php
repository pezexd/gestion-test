<?php

namespace App\Http\Middleware;

use App\Http\Resources\V1\UserResource;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->wantsJson()) {
                    $user = auth()->user();
                    $user->roles;
                    $user->profile;
                    return response()->json([
                        'message' => 'Autenticado!',
                        'user' => $user
                    ]);
                    // 'user'=> new UserResource(auth()->user())
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
