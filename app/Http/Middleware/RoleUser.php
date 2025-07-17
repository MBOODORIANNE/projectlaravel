<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUser
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Non authentifié');
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
}
